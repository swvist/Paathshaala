<?php
/**
* Video content class. Functions/Methods dealing with video MUST be packaged here.
* Specific content must be packaged in its own class. Video class is directly inherited from content class.
* @author Vipin Nair <swvist@gmail.com>
* @author Jaseem Abid <jaseemabid@gmail.com>
* @copyright Copyright (c) 2011, Vipin Nair & Jaseem Abid
* @license http://www.gnu.org/licenses/gpl.html GNU General Public License 
* @package video
*/

/**
* Includes Base class content
*/
include 'class.content.php';
/**
*  
*/
class video extends content
{
	protected $serverid, $path, $file;
	
	/**
	* The constructor selects the appropriate function based on the number of
	* arguments and calls the appropriate protected function.
	*/
	public function __construct()
	{
		$a = func_get_args();
        $i = func_num_args(); 
        if($i==1)
            call_user_func_array(array($this,'view'),$a);
		if($i==6)
			call_user_func_array(array($this,'create'),$a);
	}
	
	/**
	* Function is called to initialize the properties with the given $cid.
	* the protected property cid with the argument and calls the
	* getDetails() method to initialize other class properties from the database.
	* @param integer $cid Content ID
	*/
	public function view($cid)
	{
		$this->cid=$cid;
		$this->getDetails();
	}
	
	/**
	* Takes the content data (Video data) as arguments and pushes it to the database.
	* Object property $cid is initialized after data is inserted.
	* @param string $title Title of the video.
	* @param string $desc Description of the video.
	* @param integer $uid User ID who submitted the video.
	* @param integer $sid Server ID of the video where it is stored. (SP for southpark)
	* @param string $path Location of the video file WITHOUT any trailing slashes.
	* @param string $file File name of the video WITHOUT extension.
	*/
	public function create($title,$desc,$uid,$sid,$path,$file)
	{
		$this->title=pg_escape_string($title);
		$this->desc=pg_escape_string($desc);
		$this->uid=pg_escape_string($uid);
		$this->sid=pg_escape_string($sid);
		$this->path=pg_escape_string($path);
		$this->file=pg_escape_string($file);
		$sql="INSERT INTO content_video(cn_title, cn_desc, cn_userid, cf_serverid, cf_path, cv_file) VALUES('".$this->title."','".$this->desc."','".$this->uid."','".$this->sid."','".$this->path."','".$this->file."') Returning cn_id";
		$row=pg_fetch_row(dbquery($sql));
		$this->cid=$row[0];
	}
	
	/**
	* Returns the complete path of the video file. 
	* Path is of the form: http://<server_ip>/<path>/<cid><file>.ogv
	*/
	public function getCompletePath()
	{
		return getServer($this->serverid)."/".$this->path."/".$this->cid.$this->file.".ogv";
	}
	
	/**
	* Returns the complete path of the video file. 
	* Path is of the form: http://<server_ip>/thumbs/<cid><file>.png
	*/
	public function getThumbnail()
	{
		return getServer($this->serverid)."/thumbs/".$this->cid.$this->file.".png";
	}
	
	
	
	
	
}

?>
