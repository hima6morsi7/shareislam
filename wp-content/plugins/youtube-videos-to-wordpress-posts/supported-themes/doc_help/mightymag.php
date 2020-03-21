<div class="theme_documenation">
    <div class="doc_settings_details">
        <p>
            Go to <code>Default import settings</code> and go to the <code>Embed Options</code> tab.
        </p>     
        
        <div class="doc_separateur"></div>
        
        <div class="doc_content_steps_integration">

            <ul class="ul_doc_first">
                <li>
                    Set <span class="custom_field_key">format</span> to <code>Video</code>
                </li>                
                <li>
                    Set <span class="custom_field_key">Content</span> to <code>{{video_description}}</code>
                </li>
            </ul>
            
            <div class="doc_separateur"></div>
            
            <p class="doc_custom_fields">Custom Fields : </p>

            <ul class="ul_custom_fields">
                <li>
                    Set <span class="custom_field_key">mgm_featured_post_1</span> To <code>0</code> OR <code>1</code> if you would to feature the video on the Homepage Slider
                </li>  
                <li>
                    Set <span class="custom_field_key">mgm_video_encode</span> To
                    <code>
                       &lt;iframe width="560" height="315" src="https://www.youtube.com/embed/{{video_key}}" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
                    </code>                     
                </li>                
                <li>
                    Set <span class="custom_field_key">mgm_comment_type</span> To <code>wp</code> OR <code>fb</code> OR <code>none</code>  
                </li> 
                <li>
                    Set <span class="custom_field_key">mgm_full_width_switch</span> To <code>0</code> OR <code>1</code> to disable Sidebar  
                </li>   
                <li>
                    Set <span class="custom_field_key">post_views_count</span> To <code>{{video_views}}</code>
                </li>
            </ul>
            
        </div>
    </div>
</div>