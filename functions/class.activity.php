<?php
/**
* Activity Class for handling user activities on Paathsaala.
* @author Vipin Nair <swvist@gmail.com>
* @author Jaseem Abid <jaseemabid@gmail.com>
* @copyright Copyright (c) 2011, Vipin Nair & Jaseem Abid
* @license http://www.gnu.org/licenses/gpl.html GNU General Public License 
* @package content
*/

/**
* Includes files for database connectivity.
*/

include_once 'functions.php';

/**
* Class for handling user activities.
* @package activity
*/
class activity
{
	/**
	* Static function to save content likes and dislikes in the database.
	* @param integer $cid Content ID of the liked/disliked content.
	* @param integer $uid User ID who liked/disliked content.
	* @param integer $like User Preference (1:Like | -1:Dislike)
	* @return integer Like ID identifying the User, Content and Preference (like/dislike)
	*/
	public static function like($cid,$uid,$like)
	{
		$sql="Insert into like(lk_cid,lk_uid,lk_like) values('".$cid."','".$uid."','".$like."') returning lk_id";
		return pg_fetch_result(dbquery($sql),0,0);
	}
	
	/**
	* Stores feedback in the database. Anonymous users will have a special user ID.
	* Name/Email of the Anonymous user should be appended to the description.
	* @param string $ip IP address of the user.
	* @param string $uid User ID, Anonymous user will have special user ID. NOT fixed yet.
	* @param string $type Type of Feedback (I: idea, X:problem, P: praise, Q: question)
	* @param string $desc Feedback message
	* @return integer Feedback ID
	*/
	public static function feedback($ip,$uid,$type,$desc)
	{
		$ip=pg_escape_string($ip);
		$uid=pg_escape_string($uid);
		$type=pg_escape_string($type);
		$desc=pg_escape_string($desc);
		$sql="Insert into feedback(fb_ip,fb_uid,fb_type,fb_desc) values('$ip','$uid','$type','$desc') returning fb_id";	
		return pg_fetch_result(dbquery($sql),0,0);
	}
	
	/**
	* Stores user comments. 
	* TODO: Crude implementation, needs to be fixed.
	* @param integer $cid Content ID
	* @param integer $uid User ID of the commentor
	* @param string $comment The comment string.
	* @return integer Comment ID of the comment.
	*/
	public static function comment($cid,$uid,$comment)
	{
		$uid=pg_escape_string($uid);
		$cid=pg_escape_string($cid);
		$comment=pg_escape_string($comment);
		$sql="Insert into comments(cm_cid,cm_uid,cm_msg) values('".$cid."','".$uid."','".$comment."') returning cm_id";
		return pg_fetch_result(dbquery($sql),0,0);
	}
}
