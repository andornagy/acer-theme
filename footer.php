
</div>
</div>

<div id="footer">

    <div id="footer_widgets">
    
        <div class="widget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_footer_one') ): ?>
    <?php endif; ?>
        </div>
    
        <div class="widget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_footer_two') ): ?>
    <?php endif; ?>
        </div>
    
        <div class="widget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_footer_three') ): ?>
    <?php endif; ?>
        </div>
        
    </div>

    <div class="clear"></div>
        
    <div class="footer_text">
            
		<?php $copy =  get_option('acer_footer_text'); ?> 
                        
            <?php if( empty( $copy ) ) { ?>
            
                Copyright &copy; <?php echo get_bloginfo('name') ?> - Powered by <a href='http://wordpress.org' target='_blank'>WordPress</a> and <a href='http://andornagy.com' target='_blank'>Theme Acer</a> by <a href='http://andornagy.com' target='_blank'>Andor Nagy</a>
            
            <?php } else { 
                    
        echo get_option('acer_footer_text');
                
    	} ?>  <a title="Return to Top" style="float:right" href="#" onclick="$('html, body').animate({ scrollTop: 0 }, 'slow'); return false">Return to top</a>
        
    </div>
          
    <div class="clear"></div>  
</div>

<?php wp_footer(); ?>


<section id="sticky_menu_warp">
	<div class="warp">
		<?php acer_menu('secondary'); ?>
	</div>
    <div class="clear"></div>
</section>
<?php echo get_option('acer_footer_code') ?>
</body>
<script type="text/javascript">
(function(d){
  var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
  p.type = 'text/javascript';
  p.setAttribute('data-pin-hover', true);
  p.async = true;
  p.src = '//assets.pinterest.com/js/pinit.js';
  f.parentNode.insertBefore(p, f);
}(document));
</script>
</html>