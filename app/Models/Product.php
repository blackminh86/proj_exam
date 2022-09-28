<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;
use App\Models\ProductCategory as Category;
use DB;

class Product extends AdminModel
{
    use HasFactory;
    protected $fillable = ['name', 'id'];
    protected $image;

    public function __construct()
    {
        $this->image               = new Images();
        $this->folderUpload        = 'product';
        $this->crudNotAccepted     = ['_token', 'thumb_current', 'alt', 'filenames', 'images_uploaded', 'images_uploaded_origin', 'attribute', 'attribute_id', 'attr_id_array', 'attribute_name', 'attribute_value', 'variation_id', 'product_id'];
    }
    public function listItems($params = null, $options = null)
    {
        $items = null;
        if ($options['task'] == "admin-list-items" || $options['task'] == "admin-list-draft") {
            $items = self::with('productCategory')->select('id', 'name', 'status', 'price', 'list_price', 'images', 'short_description', 'product_category_id', 'created_at', 'updated_at', 'type','display');

            if ($params['filter']['status'] !== "all") {
                $items = $items->where('status', '=', $params['filter']['status']);
            }
            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $items = $items->where(function ($items) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $items->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $items = $items->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
            $condition = (($options['task'] == "admin-list-draft")) ? 'yes' : null;
            $items = $items->where('draft', $condition)
                ->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if ($options['task'] == 'news-list-items-related-in-category') {
            $query = self::select('id', 'name', 'short_description', 'images', 'created_at', 'type', 'product_category_id')
                ->where('status', '=', 'active')
                ->where('draft', null)
                ->where('id', '!=', $params['product_id'])
                ->where('product_category_id', '=', $params['category_id'])
                ->take(4);
            $items = $query->get();
        }
        if ($options['task'] == 'show-items-in-category') {
            if (isset($params['category_id'])) {
                $categories = Category::descendantsAndSelf($params['category_id']);
                $categoryIdArray = [];
                foreach ($categories as $category) {
                    $categoryIdArray[] = $category->id;
                }
                $items = self::with(['attribute', 'attributeProduct'])->select('id', 'name', 'price', 'list_price', 'images', 'type', 'short_description')
                    ->whereIn('product_category_id', $categoryIdArray)
                    ->paginate($params['pagination']['totalItemsPerPage']);
            }
        }
        if ($options['task'] == 'show-items-in-search') {
            if (isset($params['product_category_id']) && isset($params['keyword'])) {
                $items = self::with(['attribute', 'attributeProduct'])->select('id', 'name', 'price', 'list_price', 'images', 'type', 'short_description')
                                ->where('name','like','%'. $params['keyword'] .'%') ;
                if($params['product_category_id'] != 1){
                    $categories = Category::descendantsAndSelf($params['product_category_id']);
                    $categoryIdArray = [];
                    foreach ($categories as $category) {
                        $categoryIdArray[] = $category->id;
                    }      
                    $items = $items->whereIn('product_category_id', $categoryIdArray)   ;
                }
                $items = $items->paginate($params['pagination']['totalItemsPerPage']);
            }
        }
        if ($options['task'] == 'show-items-in-home') {
            $items = self::select('id' , 'name' , 'list_price', 'price' , 'images' , 'type' , 'display') ;
            if(isset($params['display']) && $params['display'] != '' ){
                $items = $items->where('display' , $params['display']) ;
            } else{   
                $items = $items->where('display' , '!=' ,'normal') ;
            }   
            $items = $items->where('status' , 'active')->get(); 
        }
        return $items;
    }
    public function ajaxFrontend($params = null, $options = null)
    {
        if ($options['task'] == "changePage") {

            $categories = Category::descendantsAndSelf($params['category_id']);
            $currentPage = $params['current_page'];
            $limit = $params['limit'];
            $categoryIdArray = [];
            foreach ($categories as $category) {
                $categoryIdArray[] = $category->id;
            }
            $items = self::select('id', 'name', 'price', 'list_price', 'images', 'type', 'short_description')
                ->whereIn('product_category_id', $categoryIdArray);
            if ($params['price'] != 'position') {
                $items = $items->orderBy('price', $params['price']);
            }
            if ($params['distancePrice'] != 0) {
                $value = explode(',', $params['distancePrice']);
                $min = (int)$value[0] * 1000;
                $max = (int)$value[1] * 1000;
                $items = $items->whereBetween('price', [$min, $max]);
            }
            $items = $items->limit($limit)
                ->offset(($currentPage - 1) * $limit)
                ->get();
        }
        return $items;
    }
    public function saveItem($params = null, $options = null)
    {
        if (isset($params['price']) || isset($params['list_price'])) {
            $params['price'] = (int)Str::replace('.', '', $params['price']);
            $params['list_price'] = (int)Str::replace('.', '', $params['list_price']);
        }
        if ($options['task'] == 'add-item') {
            $params['created_by'] = "MinhNguyen" ;
            $params['images']      = $this->image->uploadMultipleImages($params['filenames'],$params['name'],$params['alt'],$params['images_uploaded'],$this->folderUpload);
            $params['content']              = htmlentities($params['content']);
            $params['short_description']    = htmlentities($params['short_description']);
            $item = new Product();
            foreach ($this->prepareParams($params) as $key => $value) {
                $item->$key = $value;
            }
            $item->save(); //get Id
        }
        if ($options['task'] == 'edit-item') {
            if (!empty($params['images_uploaded'])) {
                // Xóa hình cũ
                $this->deleteMultipleImages($params['images_uploaded_origin'], $params['images_uploaded']);
                // Up hình mới
                $params['filenames'] = (isset($params['filenames'])) ? $params['filenames'] : null;
                $params['images']      = $this->image->uploadMultipleImages($params['filenames'],$params['name'],$params['alt'],$params['images_uploaded'],$this->folderUpload);
            } else {
                $params['images']      = $this->image->uploadMultipleImages($params['filenames'],$params['name'],$params['alt'],null,$this->folderUpload);
            }
            $params['modified_by']   = "MinhNguyen";
            $params['content']              = htmlentities($params['content']);
            $params['short_description']    = htmlentities($params['short_description']);
            self::where(['id' => $params['id']])->update($this->prepareParams($params));
            if (isset($params['variation_id'])) $this->saveVariablePrice($params['variation_id']);
        }

        if ($options['task'] == 'add-draft') {
            $params['created_by'] = "MinhNguyen";
            $params['draft'] = 'yes';
            if (isset($params['images'])) {
                $params['images']      = $this->image->uploadMultipleImages($params['filenames'],$params['name'],$params['alt'],$params['images_uploaded'],$this->folderUpload);
            }
            $params['content']              = (isset($params['content'])) ? htmlentities($params['content']) : null ;
            $params['short_description']    = (isset($params['short_description'])) ? htmlentities($params['short_description']) : null;
            //self::create($this->prepareParams($params));
            $id = self::insertGetId($this->prepareParams($params));
            return $id;

        }
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::with('attribute','attributeProduct')->select('*')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-images') {
            $result = self::select('id', 'images')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-item') {
            $result = self::with(['productCategory', 'attribute', 'attributeProduct'])->select('*')
                ->where('id', $params['product_id'])
                ->where('draft', null)
                ->where('status', '=', 'active')
                ->first();
        }

        return $result;
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            $item   = $this->getItem($params, ['task' => 'get-images']);
            $this->deleteMultipleImages($item->images, null);
            self::where('id', $params['id'])->delete();
        }
    }

    public function saveAttribute($id, $params)
    {
        //Delete Old product_id
        DB::table('attribute_products')->where('product_id', $id)->delete();
        //Save attribute_products
        $data           = [];
        foreach ($params as $attribute => $value_1) {
            foreach (json_decode($value_1) as $value_2) {
                $data[] = ['product_id' => $id,  'attribute_id' => $attribute, 'value' => $value_2->value];
            }
        }
        DB::table('attribute_products')->insert($data);
    }

    public function deleteMultipleImages($images_uploaded_origin, $images_uploaded = null)
    {
        $images_uploaded_origin = json_decode($images_uploaded_origin, true);
        $images_uploaded_origin = collect($images_uploaded_origin)->pluck('image')->toArray();

        if ($images_uploaded != null) {
            $images_uploaded_origin = array_diff($images_uploaded_origin, $images_uploaded);
        }

        foreach ($images_uploaded_origin as  $image) {

            Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $image);
        }
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function attributeProduct()
    {
        return $this->hasMany(AttributeProduct::class);
    }
    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }
    public function insertAttribute($params)
    {
        $attributeIdArr = [];
        if (isset($params['attribute'])) {
            $attribute      = $params['attribute'];
            foreach ($attribute as $key => $value) {
                $id = DB::table('attributes')->insertGetId([
                    'name' => $value,
                    'product_id'   => $params['product_id']
                ]);
                $attributeIdArr[$key] = $id;
            }
        }
        return $attributeIdArr;
    }

    public function insertAttributeProduct($params, $attributeIdArr)
    {
        $attributeValueIdArr = [];
        if (isset($params['attribute_value'])) {
            $attribute_value      = $params['attribute_value'];
            //($params , $attributeIdArr , $attribute_value );
            foreach ($attribute_value  as $key => $value) {
                foreach ($value as $k => $val) {
                    $id = DB::table('attribute_products')->insertGetId([
                        'value'         => $val,
                        'product_id'    => $params['product_id'],
                        'attribute_id'  => $attributeIdArr[$key]
                    ]);
                    $attributeValueIdArr[$key][$k]['attribute_product_id'] = $id;
                    $attributeValueIdArr[$key][$k]['attribute_product_value'] = $val;
                }
            }
        }
        return $attributeValueIdArr;
    }

    public function insertVariation($id, $attributeValueIdArr)
    {
        $array      = $attributeValueIdArr;
        $data       = [];
        switch (count($array)) {
            case 1:
                foreach ($array[0] as $key => $value) {
                    $data[$key]['name']       = $value['attribute_product_value'];
                    $data[$key]['variation']  = $value['attribute_product_id'];
                    $data[$key]['product_id'] = $id;
                }
                break;
            case 2:
                $i = 0;
                foreach ($array[0] as $key => $value) {
                    $attrName_01      = $value['attribute_product_value'];
                    $attrId_01        = $value['attribute_product_id'];
                    foreach ($array[1] as $ke => $val) {
                        $attrName_02      = $val['attribute_product_value'];
                        $attrId_02        = $val['attribute_product_id'];

                        $name = $attrName_01 . '-' . $attrName_02;
                        $variation = $attrId_01  . '-' . $attrId_02;
                        $data[$i]['name']       = $name;
                        $data[$i]['variation']   = $variation;
                        $data[$i]['product_id'] = $id;
                        $i++;
                    }
                }
                break;
            case 3:
                $i = 0;
                foreach ($array[0] as $key => $value) {
                    $attrName_01      = $value['attribute_product_value'];
                    $attrId_01        = $value['attribute_product_id'];
                    foreach ($array[1] as $ke => $val) {
                        $attrName_02      = $val['attribute_product_value'];
                        $attrId_02        = $val['attribute_product_id'];
                        foreach ($array[2] as $k => $va) {
                            $attrName_03      = $va['attribute_product_value'];
                            $attrId_03        = $va['attribute_product_id'];
                            $name             = $attrName_01 . '-' . $attrName_02 . '-' . $attrName_03;
                            $variation        = $attrId_01  . '-' . $attrId_02  . '-' . $attrId_03;
                            $data[$i]['name']       = $name;
                            $data[$i]['variation']  = $variation;
                            $data[$i]['product_id'] = $id;
                            $i++;
                        }
                    }
                }
                break;
        }
        $result = DB::table('variation_products')->insert($data);
    }
    public function loadVariation($id)
    {
        $result = DB::table('variation_products')->select('id', 'name', 'variation', 'price','status')
            ->where('product_id', $id)
            ->get();
        return $result;
    }
    
    public function deleteVariation($id)
    {
        DB::table('variation_products')->where('product_id', $id)->delete();
        DB::table('attribute_products')->where('product_id', $id)->delete();
        DB::table('attributes')->where('product_id', $id)->delete();
    } 
    public function deleteVariableElement($id)
    {
        DB::table('variation_products')->where('id', $id)->delete();
    }
    public function saveVariablePrice($array)
    {
        foreach ($array as $key => $value) {
            $price = (int)Str::replace('.', '', $value);
            DB::table('variation_products')
                ->where('id', $key)
                ->update(['price' => $price]);
        }
    }
    public function scrapDataTk($params)
    {
        // $params =($from , $to, $limit, $category);
        $count = 0;
        if (isset($params['category_id'])) {
            $categories = $params['category_id'];
            $from = (isset($params['form'])) ? $params['form'] : 1;
            $to = (isset($params['to'])) ? $params['to'] : 1;
            $limit = (isset($params['limit'])) ? $params['limit'] : 48;
            $area = (isset($params['area'])) ? $params['area'] : '';
            $service = (isset($params['service'])) ? $params['service'] : '';
            foreach ($categories as  $category_id) {
                for ($i = $from; $i <= $to; $i++) {
                    $link = "https://tiki.vn/api/v2/products?limit=$limit&category=$category_id&page=$i&$service&$area";
                    $json = file_get_contents($link);
                    $data = json_decode($json, true);
                    if (isset($data['data'])) {
                        $items  = $data['data'];
                        $array = array();
                        foreach ($items as $key => $item) {
                            $image  =  $item['thumbnail_url'];
                            $short_description =    (isset($item['short_description'])) ? addslashes(htmlentities($item['short_description'])) : null;
                            $array[$key]['ecommerce_id']         = $item['id'];
                            $array[$key]['name']                 = addslashes(htmlentities($item['name']));
                            $array[$key]['short_description']    = trim(preg_replace('/\s\s+/', ' ', $short_description));
                            $array[$key]['list_price']           = (isset($item['list_price']) && ($item['list_price']) != null) ? ($item['list_price']) : $item['price'];
                            $array[$key]['price']                = $item['price'];
                            $array[$key]['images']               = json_encode(array(['image' => $image, 'alt' => Str::slug($array[$key]['name'])]));
                            $array[$key]['product_category_id']  = $category_id;
                            $array[$key]['status']               = 'active';
                            $array[$key]['type']                 = 'scrape';
                            //$array[$key]['rating_average']       = $item['rating_average'];
                            //$array[$key]['brand']                = $item['brand_name'];
                            //$array[$key]['delivery']             = $item['inventory']['fulfillment_type'];
                        }
                        $count += $key + 1;
                        self::insert($array);
                    }
                }
            }
        }
        return ['count' => $count, 'category_id' => $category_id];
    }
    public function getVariationTk($beginId, $lastId)
    {
        $beginId = ($beginId == null) ? 0 : $beginId;
        $items = self::select('id', 'ecommerce_id')->where('type', 'scrape')
            ->whereBetween('id', [$beginId, ($lastId + 1)])
            ->get()->pluck('ecommerce_id', 'id');
        foreach ($items as $id => $ecommerce_id) {
            $url = "https://tiki.vn/api/v2/products/$ecommerce_id";
            $json = file_get_contents($url);
            $data = json_decode($json, true);
            if (isset($data['configurable_options'])) {
                $attributes = $data['configurable_options'];
                $params = [];
                $params['product_id'] = $id;
                foreach ($attributes as $key => $attribute) {
                    $params['attribute'][]  = $attribute['name'];
                    foreach ($attribute['values'] as $value) {
                        $params['attribute_value'][$key][] = $value['label'];
                    }
                }

                $attributeIdArr      = self::insertAttribute($params);
                $attributeValueIdArr = self::insertAttributeProduct($params, $attributeIdArr);
                self::insertVariation($id, $attributeValueIdArr);
                $variations  = $data['configurable_products'];
                // $number : number of attribute
                $number = $key + 1;
                self::updateVariableTk($variations, $number, $params['product_id']);
            }
        }
    }
    public function updateVariableTk($variations, $number, $product_id)
    {
        foreach ($variations as $variation) {
            if (isset($variation['option1'])) {
                $name = '';
                for ($i = 1; $i <= $number; $i++) {
                    $name .= '-' . $variation['option' . $i];
                }
                $name = ltrim($name, "-");
                $active = ($variation['inventory_status'] == 'available') ? 'active' : 'inactive';
                DB::table('variation_products')->where('name', $name)
                    ->where('product_id', $product_id)
                    ->update([
                        'price'                  => $variation['price'],
                        'variation_ecommerce_id' => $variation['id'],
                        'thumbnail'              => $variation['thumbnail_url'],
                        'status'                 => $active,
                        'seller_id'              => $variation['seller']['id'],
                    ]);
            }
        }
    }
    public function getAttribue($products, $value)
    {
        $ids = [];
        foreach ($products as $product) {
            foreach ($product->attribute as $attribute) {
                if (in_array($attribute->name , $value)) {;
                    $ids[] = $attribute->id;
                }
            }
        }
        return $ids;
    }
    public function showAttribue($products, $ids)
    {
        $value_attributes = [];
        foreach ($products as $product) {
            foreach ($product->attributeProduct as $attributeProduct) {
                if (in_array($attributeProduct->attribute_id, $ids)) {
                    $value_attributes[] = $attributeProduct->value;
                }
            }
        }
        return array_unique($value_attributes);
    }
    public function callAPI($ecommerce_id){
        $link = "https://tiki.vn/api/v2/products/$ecommerce_id";
        $json = file_get_contents($link);
        $data = json_decode($json, true);
        return $data ;
    }
}
