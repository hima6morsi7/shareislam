<?php //var_dump($theme_infos); ?>
<div class="theme_documenation">
    <div class="doc_settings_details">
        <p>
            Go to <code>Default import settings</code> and go to the <code>Embed Options</code> tab.
        </p>     
        
        <div class="doc_separateur"></div>
        
        <div class="doc_content_steps_integration">

            <ul class="ul_doc_first">
                <li>
                    Set <span class="custom_field_key">format </span> to <code>Video</code>
                </li>
                <li>
                    Set <span class="custom_field_key">Content</span> to <code>{{video_description}}</code>
                </li>                
            </ul>
            
            <div class="doc_separateur"></div>
            
            <p class="doc_custom_fields">Custom Fields : </p>

            <ul class="ul_custom_fields">
                <li>
                    Set <span class="custom_field_key">td_video</span> To <code>{{video_url}}</code>  
                </li>
                <li>
                    Set <span class="custom_field_key">post_views_count</span> To <code>{{video_views}}</code>  
                </li>
                <li>
                    Set <span class="custom_field_key">td_post_video</span> To <code>{"td_video":"{{video_url}}"}</code>  
                </li>                
            </ul>
        </div>
    </div>
</div>