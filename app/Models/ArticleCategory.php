<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model ;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends AdminModel
{
    use NodeTrait;
    use HasFactory;
    protected $fillable = ['name'];
    public function __construct()
    {
        $this->crudNotAccepted     = ['_token'];
        $this->folderUpload        = 'category';
        $this->fieldSearchAccepted = ['name'];
    }

    public function listItems($params = null, $options = null)
    {
        $items = null ;
        if ($options['task'] == "admin-list-items") {
            $items = self::withDepth()->where('id','>',1) ;

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

                $items = $items ->orderBy('_lft', 'asc')->get();                    
        }
        return $items;
        
    }
    /** Nested Set Model */
    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getparent_idIdName()
    {
        return 'parent_id';
    }

    // Specify parent_id id attribute mutator
    public function setparent_idAttribute($value)
    {
        $this->setparent_idIdAttribute($value);
    }

    public function getNameWithDepthAttribute()
    {   
        $result ='';  
        if($this->id == 1){
            $result = '--- ' .ucfirst($this->name). ' ---'; 
        }
        if($this->id >> 1){
            $result = str_repeat('/---', $this->depth -1) . " " . $this->name; 
        }
        return $result;
    }
    public function getNameWithDepthWithIdAttribute()
    {   
        $result ='';  
        if($this->id == 1){
            $result = '--- ' .ucfirst($this->name.'_'.$this->id). ' ---'; 
        }
        if($this->id >> 1){
            $result = str_repeat('/---', $this->depth -1) . " " . $this->name.'_'.$this->id; 
        }
        return $result;
    }
    public function move($params)
    { 
        $result = [];
        if (isset($params['currentPage'])) {
            
            if(isset($params['up'])){
                $node = self::find($params['up']);
                $prev   = $node->getPrevSibling();
                //Deal node
                self::where('id', $node->id)->update(['_lft' => $prev->_lft, '_rgt' => $prev->_rgt]);
                //Deal up
                self::where('id', $prev->id)->update(['_lft' => $node->_lft, '_rgt' => $node->_rgt]);
                self::fixTree(); 
                //$bool = $node->up();
            } ;

            if(isset($params['down'])){
                $node = self::find($params['down']);
                $next = $node->getNextSibling();
            //Deal _lft & _rgt of node
                self::where('id', $node->id)->update(['_lft' => $next->_lft, '_rgt' => $next->_rgt]);
            //Deal _lft & _rgt of up
                self::where('id', $next->id)->update(['_lft' => $node->_lft, '_rgt' => $node->_rgt]);
                self::fixTree(); 
                //$bool = $node->down();
      
            } ;
        }
            $limit = $params['limit'] ;
            $offset = ($params['currentPage'] * $limit ) - $limit ;
            $result = self::withDepth()
                            ->where('id','>',1)
                            ->offset($offset)
                            ->limit($limit)
                            ->orderBy('_lft', 'asc')
                            ->get();            
        return $result ;
    }
}