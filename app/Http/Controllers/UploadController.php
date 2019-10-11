<?php

namespace App\Http\Controllers;

use Qcloud\Cos\Client;

class UploadController extends Controller
{
    public function getCosClient()
    {
        return new Client([
            'region' => env('REGION'), #地域，如ap-guangzhou,ap-beijing-1
            'credentials' => array(
                'secretId' => env('COS_KEY'),
                'secretKey' => env('COS_SECRET'),
            )]);
    }

    public function uploadToCos($cos_path, $local_path)
    {
        $client = $this->getCosClient();
        $bucket = env('COS_BUCKET');
        $client->putObject([
            'Bucket' => $bucket,
            'Key' => $cos_path,
            'Body' => fopen($local_path, 'rb')
        ]);
    }

    public function doUpload()
    {
        if ($this->request->hasFile('file') && $this->request->file('file')->isValid()) {
            $file_path = $this->request->file->path();
            $extension = $this->request->file->extension();
            $mime_type = $this->request->file->getClientMimeType();
            if (!is_numeric(strpos($mime_type, 'image'))) {
                $mime_type = 'file';
            } else {
                $mime_type = 'image';
            }
            $url = sprintf(
                '/uploads/%s/%s/%s.%s',
                $mime_type,
                date('Ymd'),
                uniqid(),
                $extension
            );
            try {
                $this->uploadToCos($url, $file_path);
                return $this->helper->returnJson([
                    0, ['url' => $url], '上传成功'
                ]);
            } catch (\Exception $exception){
                return $this->helper->returnJson([1, [], $exception->getMessage()]);
            }
        }

        return $this->helper->returnJson([1, [], '参数文件类型错误']);
    }
}