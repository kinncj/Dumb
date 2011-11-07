<?php
namespace Arizona\Common;
/**
 * Dump Post Validator
 * @example DumbPostValidator::check($_POST,array('observacao','opcional'))
 * @author kinncj
 *
 */
class PostValidator
{
    public static function check( $post, array $toIgnore = array(), $merge = true )
    {
        $ignore = array_intersect(array_keys($post), $toIgnore);
        foreach ($ignore as $ignored) {
            unset($post[$ignored]);
        }
        $error = null;
        $notignore = array();
        foreach ($post as $key => $value) {
            $notignore[$key] = $value;
            if (strpos($key, 'notreq_') !== false) {
                unset($notignore[$key]);
                $key = str_replace('notreq_', '', $key);
                $notignore[$key] = $value;
                continue;
            }
            if (is_array($value)) {
                $notignore[$key] = self::check($value, $toIgnore, false);
            }
            if (empty($value)) {
                $error .= "\n" . ucfirst($key) . ", cannot be null\n";
            }
        }
        if (! empty($error)) {
            header('Precondition Failed', true, 412);
            throw new \Exception($error, 400);
        }
        if ($merge) {
            /*
             * Thiagophx (Thiago Rigo) FIXED this
             */
            return array_merge($ignore, $notignore);
        }
        return $notignore;
    }
}
