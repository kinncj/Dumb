<?php
/** 
 * @author kinncj
 * 
 * 
 */
class CurlUploader
{
    public static function doUpload( array $post_parameters = array(), array $files_parameters = array(), $url )
    {
        $response = array();
        if (count($files_parameters) <= 0) {
            throw new \Exception('Please, send-me files!');
        }
        if (isset($files_parameters['tmp_file'])) {
            return var_dump(self::iDoUpload($files_parameters, $url));
        }
        foreach ($files_parameters as $key => $files) {
            $response = self::iDoUpload($post_parameters, $files, $url);
        }
        echo ($response);
    }
    public static function iDoUpload( $post_parameters, $files_parameters, $url )
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        move_uploaded_file($files_parameters['tmp_name'], "/tmp/{$files_parameters['name']}");
        $post_array = array("Filedata" => "@" . "/tmp/{$files_parameters['name']}");
        //unset($_POST['Filedata']);
        foreach ($post_parameters as $key => $value) {
            $post_array[$key] = $value;
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
        return (curl_exec($ch));
    }
}
?>
