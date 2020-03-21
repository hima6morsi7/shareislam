<?php
class UtilsController_YVTWP {
    
    /*
     * 
     */
    public function getUsersByRoleAction($arg)
    {
        $result= Post_YVTWP::getUsersByRole($arg['author_role']);
        return new Response_YVTWP(1, $messages='yes', $result);
    }
    /*
     * 
     */
    public function getTaxonomyByPostTypeAction($arg)
    {
        $result= Post_YVTWP::getTaxonomiesByPostType($post_type=$arg['taxonomies_post_type']);
        return new Response_YVTWP(1, $messages='yes', $result);        
    }
    /*
     * 
     */
    public function getCategoriesByTaxonomyAction($arg)
    {
        $result= Post_YVTWP::getCategoriesByTaxonomy($arg['taxonomy']);
        return new Response_YVTWP(1, $messages='yes', $result);
    }
    /*
     * 
     */
    public function existAuthorLoginAction($arg)
    {
        $response=new Response_YVTWP(0,__('Invalid user login','YVTWP-lang'), NULL);
        $login=$arg['login'];
        
        if(!empty($login))
        {
            $user=get_user_by('login',$login);
            if($user)
            {
                $result['user_id']=$user->ID;
                $response->status=1;
                $response->result=$result;
            }
        }
        
        return $response;
    }
 
    
}
?>