<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group custom_footerclass">

				<div class="footer_customize">
					<div class="row">
						<div class="col-md-4 footer_blocks">
							<h4>Radhika Bapat</h4>
							<p>Email:<br><a href="mailto:psychotherapybarofficial@gmail.com">psychotherapybarofficial@gmail.com</a></p>
							<!--<p>Phone:<br>
							+91 123 456 7890</p>-->
						</div>
						<div class="col-md-4 footer_blocks ft_recent_popular">
							<h4>Recent Popular</h4>
							<?php
                                $the_query = new WP_Query( array(
                                    'category__not_in' => array( 8 ),'posts_per_page'=>'2' )); ?>
                                <?php while ($the_query -> have_posts()) : $the_query->the_post(); ?>
                                    <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br/>
                                        <?php echo get_the_date( '', $the_query->ID ); ?> </p>
                                <?php ?>
                                <?php
                                endwhile;
                                wp_reset_postdata();
							?>
						</div>
						<div class="col-md-4 footer_blocks last_block">
							<h4>Get in Touch</h4>
							<div class="socials_media">
								<a class="pl-0" href="https://www.facebook.com/radhika.bapat.129" target="_blank"><img src="/wp-content/uploads/2021/04/facebook-icon.png"></a>
								<a href="https://twitter.com/radhikasbapat" target="_blank"><img src="/wp-content/uploads/2021/04/twitter-icon.png"></a>
								<a href="https://www.linkedin.com/in/radhika-bapat-b708a957/" target="_blank"><img src="/wp-content/uploads/2021/04/linked-icon.png"></a>
								<a href="https://www.instagram.com/psychotherapybar/?igshid=tx5u4plyjdhd" target="_blank"><img src="/wp-content/uploads/2021/04/instagram-icon.png"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://www.php.net/manual/datetime.format.php */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							Radhika S. Bapat
						</p><!-- .footer-copyright -->

						<p class="powered-by-wordpress">
							All Rights Reserved.
						</p><!-- .powered-by-wordpress -->

					</div><!-- .footer-credits -->
					
					<div class="custom-footer_right">
						<a href="/disclaimer">Disclaimer</a>
						<img src="http://rb.webstaging.in/wp-content/uploads/2021/05/cc.png">
					</div>

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
							<?php
							/* translators: %s: HTML character for up arrow. */
							printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<?php
							/* translators: %s: HTML character for up arrow. */
							printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->


		<?php wp_footer(); ?>

	  <a href="#" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a> 


<script>
	jQuery("#swp_category_limiter option[value=" + 8 + "]").hide();
</script>

<script>
	jQuery(document).ready(function(){
				jQuery('.search_txt').prependTo('.searhbycat_block');
			});
</script>

	<script>
		
      jQuery(document).ready(function(){
		  var swiper = new Swiper(".advnds-slider", {
                loop: true,
                navigation: {
                    prevEl: '.elementor-swiper-button-prev',
                    nextEl: '.elementor-swiper-button-next'
                },
            });
		  jQuery("#elementor-tab-title-4652").click(function(){
			var swiper = new Swiper(".advnds-slider", {
                loop: true,
                navigation: {
                    prevEl: '.elementor-swiper-button-prev',
                    nextEl: '.elementor-swiper-button-next'
                },
            });
		  })
        jQuery(window).scroll(function(){ 
          if (jQuery(this).scrollTop() > 100) { 
            jQuery('#scroll').fadeIn(); 
          } else { 
            jQuery('#scroll').fadeOut(); 
          } 
        }); 
        jQuery('#scroll').click(function(){ 
          jQuery("html, body").animate({ scrollTop: 0 }, 600); 
          return false; 
        }); 
      });
    </script>

		<script>

			/* header script */
            jQuery(document).ready(function() {
              if (jQuery(this).scrollTop() > 1){  
               jQuery('.navibar').addClass("header-alt");
             }
           });
         
          jQuery(window).scroll(function() {
          if (jQuery(this).scrollTop() > 1){  
            jQuery('.navibar').addClass("header-alt");
          }
          else{
           jQuery('.navibar').removeClass("header-alt");
         }
          });
         /* header script */
		</script>

		<script>
			jQuery(document).ready(function(){
				jQuery('.custom-logo-link .custom-logo').addClass('startlogo');
			});

			jQuery(document).ready(function(){
				jQuery('.header-titles .site-logo').addClass('logo_inverse');
			});
			
			jQuery(document).ready(function(){
				jQuery('.p_header .header-titles').addClass('js-replace');
			});
		</script>

		<script>
			var bleep = new Audio();
			bleep.src = '/wp-content/uploads/2021/04/zapsplat_multimedia_button_click_006_53867.mp3';
		</script>

	<script>


	console.clear();

const app = (() => {
	let body;
	let menu;
	let menuItems;
	
	const init = () => {
		body = document.querySelector('body');
		menu = document.querySelector('.menu-icon');
		menuItems = document.querySelectorAll('.nav__list-item');

		applyListeners();
	}
	
	const applyListeners = () => {
		menu.addEventListener('click', () => toggleClass(body, 'nav-active'));
	}
	
	const toggleClass = (element, stringClass) => {
		if(element.classList.contains(stringClass))
			element.classList.remove(stringClass);
		else
			element.classList.add(stringClass);
	}
	
	init();
})();


</script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--<script type="text/javascript"> 
	

    

	jQuery(window).scroll(function() { var scroll = jQuery(window).scrollTop(); if (scroll >= 450) { jQuery("#homeabout").addClass("darkHeader"); } else { jQuery("#homeabout").removeClass("darkHeader"); } });
	
	jQuery(window).scroll(function() { var scroll = jQuery(window).scrollTop(); if (scroll >= 2000) { jQuery("#homeabout2").addClass("darkHeader"); } else { jQuery("#homeabout2").removeClass("darkHeader"); } });
</script>--> 

   <script>
        jQuery(".menu-icon").click(function () {
            jQuery(".nav").addClass("zindex");

            jQuery(".menu-icon").click(function () {
                jQuery(".nav").removeClass("zindex");
            }, 3000);
        });
    </script> 

	
<?php if(is_front_page() && !\Elementor\Plugin::$instance->preview->is_preview_mode()) { ?>
<script src="/wp-content/themes/radhikatheme-child/js/jquery-ui.min.js"></script>
<script src="/wp-content/themes/radhikatheme-child/js/jquery.transit.min.js"></script>

<script>
	
    jQuery(function() {
        var elem = ".drag-button";
        var myStart;
        var audio = document.querySelector(".audio");

        jQuery(elem).draggable({
            containment: "parent",
            cursor: "move",
            scroll: false,
            addClasses: true,
            start: function(e, ui) {
                myStart = ui.position;
            },
            drag: function(e, ui) {
                ui.position.left = Math.min( 75, ui.position.left );
                jQuery('.drag-target').css('left', - ui.position.left);
                if(ui.position.left >= 75){
					var now = new Date();
					now.setTime(now.getTime() + 60 * 60 * 1000);
					document.cookie = "welcomescreen=Welcome screen; expires=" + now.toUTCString() + "; path=/";

                    audio.pause();
                    jQuery('.welcome_block .loader-logo').transition({scale: 0.5, y: '-'+jQuery(".welcome_block img").position().top+30,duration:700 });
                    jQuery('.drag-container').transition({y: '-20px',opacity:0,duration:1000});
                    jQuery('.drag .welcome_block p').transition({ y: '-20px',opacity:0,duration:1000 });
                    jQuery('.drag > p').transition({ y: '-20px',opacity:0,duration:1000 });
                    jQuery('.drag').transition({ y: '-100vh',opacity:0,delay:700,duration:700 });
                    jQuery('.bg').transition({ opacity:0,delay:1000,duration:1300});
                    jQuery('#site-content').transition({ opacity:1,y: '0px',delay:1100,duration:1200 });
					jQuery('.welcome_copyright').transition({ opacity:0,delay:500,duration:700 });
                    // jQuery('.bg').addClass('drag-success');
                    // jQuery('.drag').addClass('drag-success');
                    setTimeout(function () {
                        jQuery('.bg,.drag').hide()
                    },1800)


                }
                if (ui.position.left < 0) {

                    return false;
                }
            },
            stop: function(e, ui) {
                //some stuff happens here, not relevant
            }
        });
    });

    jQuery(function() {
        var elem = ".drag-target";
        var myStart;
        var audio = document.querySelector(".audio");

        jQuery(elem).draggable({
            containment: "parent",
            cursor: "move",
            scroll: false,
            addClasses: true,
            start: function(e, ui) {
                myStart = ui.position;
            },
            drag: function(e, ui) {
                jQuery('.drag-button').css('left',- ui.position.left);
                if (ui.position.left > 0 || ui.position.left < -75 ) {
					var now = new Date();
					now.setTime(now.getTime() + 60 * 60 * 1000);
					document.cookie = "welcomescreen=Welcome screen; expires=" + now.toUTCString() + "; path=/";
                    audio.pause();
                    jQuery('.welcome_block .loader-logo').transition({scale: 0.5, y: '-'+jQuery(".welcome_block img").position().top+30,duration:700 });
                    jQuery('.drag-container').transition({y: '-20px',opacity:0,duration:1000});
                    jQuery('.drag .welcome_block p').transition({ y: '-20px',opacity:0,duration:1000 });
                    jQuery('.drag > p').transition({ y: '-20px',opacity:0,duration:1000 });
                    jQuery('.drag').transition({ y: '-100vh',opacity:0,delay:700,duration:700 });
                    jQuery('.bg').transition({ opacity:0,delay:1000,duration:1300});
                    jQuery('#site-content').transition({ opacity:1,y: '0px',delay:1100,duration:1200 });
					jQuery('.welcome_copyright').transition({ opacity:0,delay:500,duration:700 });
                    // jQuery('.bg').addClass('drag-success');
                    // jQuery('.drag').addClass('drag-success');
                    setTimeout(function () {
                        jQuery('.bg,.drag').hide()
                    },1800)

                    return false;

                }
            },
            stop: function(e, ui) {
                //some stuff happens here, not relevant
            }
        });
    });

    jQuery('.welcome_block .loader-logo').transition({ y: '10px',duration:1000 });
    jQuery('.drag .welcome_block p').transition({ opacity:1,y: '0px',delay:500,duration:1200 });
    jQuery('.drag-container').transition({scale: 1,duration:1500,delay:700});
    jQuery('.drag > p').transition({ opacity:1,y: '0px',delay:1000,duration:1200 });
	jQuery('.welcome_copyright').transition({ opacity:1,delay:1000,duration:1200 });
	
	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	if(getCookie('welcomescreen') !== 'Welcome screen'){
		  jQuery('#site-content').transition({ opacity:0,y: '0',delay:1000,duration:1200 });
	}


    var pause = document.querySelector(".pause");
    var audio = document.querySelector(".audio");

    function togglePlay() {
        if (audio.paused) {
            audio.play();
            pause.innerHTML = "<img src='http://rb.zero-designs.in/wp-content/uploads/2021/05/mute.svg'>";
        } else {
            audio.pause();
            pause.innerHTML = "<img src='http://rb.zero-designs.in/wp-content/uploads/2021/05/volume.svg'>";
            pause.style.color = " #848484";
        }
    }

</script>

<script>
if( jQuery('#customclass').hasClass('drag') === true ) 
{
 jQuery('body').addClass('overflowhidden');
}
</script>

<script>
jQuery(document).ready(function() {
   
   jQuery("#customclass").click(function(){
      jQuery('body').addClass('overflowvisible')
    });
   
 });
</script>


<?php } ?>
	</body>
</html>
