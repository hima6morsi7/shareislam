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
                    Set <span class="custom_field_key">tm_video_url</span> To <code>{{video_url}}</code>  
                </li> 
                <li>
                    Set <span class="custom_field_key">time_video</span> To <code>{{video_duration}}</code>  
                </li>               
                <li>
                    Set <span class="custom_field_key">tm_video_code</span> To
                    <code>
                       &lt;iframe width="640" height="360" src="https://www.youtube.com/embed/{{video_key}}?rel=0" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
                    </code>  
                    <span class="help_y">
                       You may adjust the width and height to fit your needs
                    </span>                     
                </li>
            </ul>
        </div>
    </div>
</div>