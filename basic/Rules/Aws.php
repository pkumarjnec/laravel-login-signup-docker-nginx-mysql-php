<?php
/**
 * Cookies file
 *
 * PHP version 7.2
 *
 * @category  Rules
 * @package   Rules
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 Braviara Technologies LLP (ABN 77 084 670 600)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      http://www.bravechat.com/
 */
namespace Basic\Rules;

use Basic\Interfaces\AwsBase;
use League\Flysystem\Config;

/**
 * The class to validate input request
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://www.bravechat.com/
 */
class Aws implements AwsBase
{
    //Upload Files/Images to AWS S3
    static function upload($file) : string {
       if($file->getClientOriginalExtension() != ''){
            $sharedConfig       = ['region'=>config('services.s3.region'),'version'=>'latest','credentials'=>array('key'=>config('services.s3.key'),'secret'=>config('services.s3.secret'))];
            $sdk                = new \Aws\Sdk($sharedConfig);
            $client             = $sdk->createS3();
            $bucket				= config('services.s3.bucket');
            $name				= self::cleanAllSpecialChar($file->getClientOriginalName()).'-'.date('YmdHis').'.'.$file->getClientOriginalExtension();
            $file_Path 		    = $file->getPathname();
            $name               = 'dev/documents/'.$name;
            $result = $client->putObject([
                'Bucket' => $bucket,
                'Key'    => $name,
                'SourceFile' => $file_Path,
                'ACL'    => 'public-read',
            ]);
            return $result['ObjectURL'];
        }
        return false;
    }

    //Get File Content
    static function download(string $fileUrl) : string {
        $arrContextOptions  = array("ssl"=>array("verify_peer" => false,"verify_peer_name" => false));
        $content            = file_get_contents($fileUrl,false, stream_context_create($arrContextOptions));
        if($content != ''){
            return $content;
        }
        return false;
    }

    //Remove All Special Character
    static function cleanAllSpecialChar($data){
        if($data != '') {
            $data	= preg_replace('/[^a-zA-Z0-9]/','', $data);
        }
        return $data;
    }

}