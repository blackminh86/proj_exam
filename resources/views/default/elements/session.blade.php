@php 
use App\Models\Setting;
//================== Session =======================
$generalSetting = Setting::where('type_setting', 'setting_general')->get() ;
        $content = ($generalSetting != null) ? json_decode($generalSetting[0]->description) : null ;
        $info = [] ;
        $info['hotline']   = json_decode($content->hotline) ;
        $info['email']     = json_decode($content->email) ;
        $info['title']     = $content->title ;
        $info['copyright'] = $content->copyright ;
        $info['address']   = $content->address ;
        $info['content']   = $content->content ;
        $info['url_map']   = $content->url_map ;
        $info['logo']      = $content->logo ;
Session::put('info' , $info);
@endphp