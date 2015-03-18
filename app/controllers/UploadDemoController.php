<?php
use Illuminate\Http\Response;

/**
 * Upload controller
 * @author nguyenle
 *
 */
class UploadDemoController extends BaseController
{
    public $restful = true;
    
    public function indexAction() {
        return View::make('upload-demo/index');
    }
    
    /**
     * Upload action
     * @return string
     */
    public function uploadAction() {
        $valid_image_exts = array('jpeg', 'jpg', 'png', 'gif');
        $valid_video_exts = array('avi', 'mp4', 'mkv', 'mov');
        
        // valid extensions
        $max_size = 100000 * 1024 * 1024;
        
        // max file size (10Mb)
        $subPath = '/uploads';
        $path = public_path() . $subPath;
        
        // upload directory
        if (!is_dir($path)) {
            $ret = mkdir($path);
            if (!$ret) {
                throw new \RuntimeException("Could not create target directory to move temporary file into.");
            }
        }
        var_dump(Input::get('type'));die();
        $fileName = NULL;
        $thumbName = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $files = Input::file('files');
            foreach ($files as $file) {                
                // get uploaded file extension
                // $ext = $file['extension'];
                $ext = $file->guessClientExtension();                
                // get size
                $size = $file->getClientSize();                
                // looking for format and size validity
                $name = $file->getClientOriginalName();

                if (in_array($ext, $valid_image_exts) and $size < $max_size) {
                    
                    // move uploaded file from temp to uploads directory
                    if ($file->move($path, $name)) {
                        $status = 'success';
                        $message = 'Image successfully uploaded!';
                        $fileName = $name;
                        
                        // create thumb for this image here
                        // open an image file
                        $img = Image::make($path . '/' . $fileName);
                        $img->resize(100, 100);                        
                        /*// insert a watermark
                        $img->insert('public/watermark.png');*/

                        // save image in desired format
                        $thumbName = '100x100_thumb_' . $fileName;
                        $img->save($path . '/' . $thumbName);
                    } 
                    else {
                        $status = 'error';
                        $message = 'Upload Fail: Unknown error occurred!';
                    }
                } 
                else if (in_array($ext, $valid_video_exts) and $size < $max_size) {
                    
                    // move uploaded file from temp to uploads directory
                    if ($file->move($path, $name)) {
                        $status = 'success';
                        $message = 'Image successfully uploaded!';
                        $fileName = $name;

                        // create thumb for this video here
                        $name_array = explode('.', $fileName);
                    	$thumbVideoName = 'thumb-' . substr($fileName, 0, strrpos($fileName, '.'));
                    	$thumbName = 'thumb-' . $thumbVideoName . '.jpg';
                        $thumbFile = $path . '/' . $thumbVideoName;
                        Sonus::getThumbnails($path . '/' . $fileName, $thumbFile, 1); 
                    } 
                    else {
                        $status = 'error';
                        $message = 'Upload Fail: Unknown error occurred!';
                    }
                } 
                else {
                    $status = 'error';
                    $message = 'Upload Fail: Unsupported file format or It is too large to upload!';
                }
            }
        } 
        else {
            $status = 'error';
            $message = 'Bad request!';
        }
        
        // echo out json encoded status
        return header('Content-type: application/json') . json_encode(array('status' => $status, 
        	'message' => $message, 
        	'fileName' => $subPath . '/' . $fileName,
        	'thumbName' => $subPath . '/' . $thumbName ));
        
        //return Response::json(array('status' => 'Group not found'));
        // resizing an uploaded file
        //Image::make($destinationPath . $filename)->resize(100, 100)->save($destinationPath . "100x100_" . $filename);
        
    }
}
