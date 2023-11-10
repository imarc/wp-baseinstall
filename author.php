<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package regenerativechangelab
 */

    /**
     * ARCHIVE TOP BANNER
     * This shows archive categories, tags, and search query results
     * Also located on archive.php */
    get_template_part('template-parts/archive-search-banner'); 

    // basic author info 
    $authorHeadshot = get_avatar(get_the_author_meta('user_email'), '200'); // Display author image, size of 200 
    $authorBio = get_the_author_meta('description'); // Displays the author description added in Biographical Info
    $authorName = get_the_author_meta('display_name'); // Displays the author name of the posts

    // get the social media stuff 
    $authorWebsite = get_the_author_meta( 'user_url' );
    $authorFacebook = get_the_author_meta( 'facebook' );
    $authorInstagram = get_the_author_meta( 'instagram' );
    $authorLinkedIn = get_the_author_meta( 'linkedin' );
    $authorMySpace = get_the_author_meta( 'myspace' );
    $authorPinterest = get_the_author_meta( 'pinterest' );
    $authorSoundCloud = get_the_author_meta( 'soundcloud' );
    $authorTumblr = get_the_author_meta( 'tumblr' );
    $authorTwitter = get_the_author_meta( 'twitter' );
    $authorYouTube = get_the_author_meta( 'youtube' );
    $authorWikipedia = get_the_author_meta( 'wikipedia' ); 
    ?>

    <div class="container">
        <div class="authorPage">

            <?php  // If user name exists, let's get that info  
            if ($authorName) { ?>
                
                
                <div class="authorPage_headshot">
                    <div class="authorPage_headshot-image">
                        <?php // Secondary profile photo
                        $author_id = get_the_author_meta( 'ID' );
                        $secondary_profile_picture = get_field('secondary_profile_picture', 'user_' . $author_id);
                        $displayAuthor = !empty($authorName) ? $authorName : 'Unknown Author';

                        if (!empty($secondary_profile_picture)) { 
                            echo wp_get_attachment_image($secondary_profile_picture, 'medium', '', [
                                'class' => 'authorPage_headshot-img',
                                'alt' => $displayAuthor
                            ]);
                        } else if (!empty($authorHeadshot)) {
                            echo $authorHeadshot;
                        } ?>
                    </div>
                </div>


                <div class="authorPage_info">

                    <?php if (!empty($authorName)) { ?>
                        <div class="authorPage_info-eyebrow">Author</div>
                        <div class="authorPage_info-name">
                            <?php echo $authorName; ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($authorBio)) { ?>
                        <div class="authorPage_info-bio">
                            <?php echo $authorBio; ?>
                        </div>
                    <?php } ?>

                    <?php // social media stuff 
                        if ( !empty($authorWebsite) || !empty($authorFacebook) || !empty($authorInstagram) || !empty($authorLinkedIn) || !empty($authorMySpace) || !empty($authorPinterest) || !empty($authorSoundCloud) || !empty($authorTumblr) || !empty($authorTwitter) || !empty($authorYouTube) || !empty($authorWikipedia) ) { ?>

                        <div class="authorPage_info-socials">
                            <?php if (!empty($authorWebsite)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorWebsite; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm10 12c0 .685-.07 1.354-.202 2h-3.853c.121-1.283.129-2.621 0-4h3.853c.132.646.202 1.315.202 2zm-.841-4h-3.5c-.383-1.96-1.052-3.751-1.948-5.278 2.435.977 4.397 2.882 5.448 5.278zm-5.554 0h-2.605v-5.658c1.215 1.46 2.117 3.41 2.605 5.658zm-4.605-5.658v5.658h-2.605c.488-2.248 1.39-4.198 2.605-5.658zm0 7.658v4h-2.93c-.146-1.421-.146-2.577 0-4h2.93zm0 6v5.658c-1.215-1.46-2.117-3.41-2.605-5.658h2.605zm2 5.658v-5.658h2.605c-.488 2.248-1.39 4.198-2.605 5.658zm0-7.658v-4h2.93c.146 1.421.146 2.577 0 4h-2.93zm-4.711-11.278c-.896 1.527-1.565 3.318-1.948 5.278h-3.5c1.051-2.396 3.013-4.301 5.448-5.278zm-6.087 7.278h3.853c-.121 1.283-.129 2.621 0 4h-3.853c-.132-.646-.202-1.315-.202-2s.07-1.354.202-2zm.639 6h3.5c.383 1.96 1.052 3.751 1.948 5.278-2.435-.977-4.397-2.882-5.448-5.278zm12.87 5.278c.896-1.527 1.565-3.318 1.948-5.278h3.5c-1.051 2.396-3.013 4.301-5.448 5.278z"/></svg><!--[if lt IE 9]><em>Website</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorFacebook)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorFacebook; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg><!--[if lt IE 9]><em>Facebook</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorInstagram)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorInstagram; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg><!--[if lt IE 9]><em>Instagram</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorLinkedIn)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorLinkedIn; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg><!--[if lt IE 9]><em>linkedin</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorMySpace)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorMySpace; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330"><path d="M272.541,168.505c29.072,0,52.725-23.576,52.725-52.556s-23.652-52.556-52.725-52.556 c-29.085,0-52.748,23.576-52.748,52.556S243.456,168.505,272.541,168.505z"/><path d=" M155.009,177.315c26.446,0,47.962-21.443,47.962-47.802c0-26.362-21.516-47.809-47.962-47.809 c-26.449,0-47.967,21.446-47.967,47.809C107.042,155.872,128.56,177.315,155.009,177.315z"/><path d="M47.494,185.239c24.079,0,43.669-19.518,43.669-43.508c0-23.998-19.59-43.521-43.669-43.521 c-24.078,0-43.668,19.523-43.668,43.521C3.826,165.722,23.416,185.239,47.494,185.239z"/><path d="M47.495,194.034C19.085,194.034,0,219.244,0,242.79v14.965c0,4.881,3.976,8.852,8.861,8.852h77.256 c4.891,0,8.869-3.971,8.869-8.852V242.79C94.986,219.244,75.903,194.034,47.495,194.034z"/><path id="XMLID_90_" d="M155.007,187.073c-31.237,0-52.221,27.727-52.221,53.621v16.629c0,5.119,4.168,9.283,9.292,9.283h85.846 c5.129,0,9.301-4.164,9.301-9.283v-16.629C207.225,214.8,186.242,187.073,155.007,187.073z"/><path d="M272.535,179.351c-34.374,0-57.465,30.52-57.465,59.023v18.475c0,5.381,4.383,9.758,9.77,9.758h95.379 c5.394,0,9.781-4.377,9.781-9.758v-18.475C330,209.87,306.909,179.351,272.535,179.351z"/></svg><!--[if lt IE 9]><em>MySpace</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorPinterest)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorPinterest; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" fill-rule="evenodd" clip-rule="evenodd"/></svg><!--[if lt IE 9]><em>Pinterest</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorSoundCloud)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorSoundCloud; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-6.417 14.583c-.354-.318-.583-.79-.583-1.323 0-.532.229-1.003.583-1.323v2.646zm1.167.417c-.212 0-.323.003-.583-.08v-3.318c.276-.088.407-.085.583-.071v3.469zm1.167 0h-.584v-3.305l.18.105c.08-.328.222-.628.404-.895v4.095zm1.166 0h-.583v-4.706c.18-.134.373-.25.583-.33v5.036zm1.167 0h-.583v-5.167c.22-.023.286-.04.583.005v5.162zm1.167 0h-.584v-4.987l.222.107c.104-.181.228-.346.362-.5v5.38zm5.885 0h-5.302v-5.904c.465-.32 1.016-.512 1.611-.512 1.583 0 2.866 1.307 2.984 2.962 1.14-.558 2.405.34 2.405 1.642 0 1-.761 1.812-1.698 1.812z"/></svg><!--[if lt IE 9]><em>SoundCloud</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorTumblr)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorTumblr; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.512 17.489l-.096-.068h-3.274c-.153 0-.16-.467-.163-.622v-5.714c0-.056.045-.101.101-.101h3.82c.056 0 .101-.045.101-.101v-5.766c0-.055-.045-.1-.101-.1h-3.803c-.055 0-.1-.045-.1-.101v-4.816c0-.055-.045-.1-.101-.1h-7.15c-.489 0-1.053.362-1.135 1.034-.341 2.778-1.882 4.125-4.276 4.925l-.267.089-.068.096v4.74c0 .056.045.101.1.101h2.9v6.156c0 4.66 3.04 6.859 9.008 6.859 2.401 0 5.048-.855 5.835-1.891l.157-.208-1.488-4.412zm.339 4.258c-.75.721-2.554 1.256-4.028 1.281l-.165.001c-4.849 0-5.682-3.701-5.682-5.889v-7.039c0-.056-.045-.101-.1-.101h-2.782c-.056 0-.101-.045-.101-.101l-.024-3.06.064-.092c2.506-.976 3.905-2.595 4.273-5.593.021-.167.158-.171.159-.171h3.447c.055 0 .101.045.101.101v4.816c0 .056.045.101.1.101h3.803c.056 0 .101.045.101.1v3.801c0 .056-.045.101-.101.101h-3.819c-.056 0-.097.045-.097.101v6.705c.023 1.438.715 2.167 2.065 2.167.544 0 1.116-.126 1.685-.344.053-.021.111.007.13.061l.995 2.95-.024.104z" fill-rule="evenodd" clip-rule="evenodd"/></svg><!--[if lt IE 9]><em>Tumblr</em><![endif]--></a>
                            <?php } ?>

                            <?php if (!empty($authorTwitter)) { ?>
                                <a class="authorPage_info-socialsIcon" href="https://twitter.com/<?php echo $authorTwitter; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg><!--[if lt IE 9]><em>Twitter</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorYouTube)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorYouTube; ?>" rel="nofollow" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg><!--[if lt IE 9]><em>YouTube</em><![endif]--></a>
                            <?php } ?>
                            
                            <?php if (!empty($authorWikipedia)) { ?>
                                <a class="authorPage_info-socialsIcon" href="<?php echo $authorWikipedia; ?>" rel="nofollow" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path d="M16.112 17.398c-1.17 2.414-2.77 5.683-3.565 7.158-0.77 1.342-1.408 1.163-1.914 0.036-1.757-4.15-5.365-11.427-7.062-15.507-0.18-0.547-0.443-1.020-0.78-1.431l0.006 0.008c-0.37-0.215-0.814-0.341-1.288-0.341-0.040 0-0.080 0.001-0.119 0.003l0.006-0c-0.262-0.030-0.391-0.094-0.391-0.199v-0.569l0.065-0.056c1.155-0.006 6.749 0 6.749 0l0.064 0.056v0.542c0 0.149-0.094 0.22-0.281 0.22l-0.705 0.039c-0.606 0.036-0.908 0.205-0.908 0.545 0.025 0.277 0.099 0.532 0.213 0.764l-0.006-0.013c1.352 3.307 6.021 13.147 6.021 13.147l0.17 0.058 3.013-6.011-0.602-1.333-2.072-4.079s-0.397-0.817-0.535-1.090c-0.91-1.803-0.89-1.897-1.808-2.021-0.259-0.029-0.391-0.062-0.391-0.186v-0.585l0.075-0.056h5.363l0.141 0.046v0.564c0 0.131-0.095 0.187-0.284 0.187l-0.385 0.059c-0.99 0.076-0.826 0.476-0.17 1.777l1.977 4.064 2.197-4.379c0.366-0.8 0.291-1.001 0.139-1.183-0.245-0.19-0.556-0.305-0.894-0.305-0.042 0-0.084 0.002-0.126 0.005l0.005-0-0.251-0.026c-0.001 0-0.001 0-0.002 0-0.068 0-0.131-0.024-0.18-0.064l0 0c-0.051-0.034-0.084-0.091-0.084-0.156 0-0.002 0-0.003 0-0.005v0-0.534l0.076-0.056c1.558-0.010 5.052 0 5.052 0l0.074 0.056v0.545c0 0.151-0.074 0.222-0.241 0.222-0.807 0.037-0.977 0.119-1.278 0.549-0.15 0.232-0.469 0.736-0.807 1.298l-2.875 5.34-0.081 0.169 3.489 7.138 0.212 0.060 5.493-13.044c0.192-0.527 0.161-0.902-0.080-1.118-0.25-0.231-0.585-0.374-0.954-0.374-0.041 0-0.082 0.002-0.122 0.005l0.005-0-0.525-0.020c-0.003 0-0.006 0-0.009 0-0.068 0-0.13-0.021-0.182-0.057l0.001 0.001c-0.051-0.032-0.085-0.086-0.090-0.148l-0-0.001v-0.545l0.074-0.056h6.199l0.051 0.056v0.546c0 0.149-0.092 0.225-0.261 0.225-0.013-0-0.029-0-0.044-0-0.655 0-1.264 0.197-1.771 0.534l0.012-0.007c-0.408 0.352-0.724 0.801-0.913 1.311l-0.007 0.022s-5.052 11.569-6.781 15.419c-0.656 1.258-1.316 1.146-1.878-0.039-0.714-1.463-2.216-4.731-3.307-7.135z"></path></svg><!--[if lt IE 9]><em>Wikipedia</em><![endif]--></a>
                            <?php } ?>
                        </div>
                        
                    <?php } ?>

                </div><?php 
            } ?>
        </div>
    </div>

    <?php 
    // if author has posts, get them 
    if ( have_posts() ) :
        get_template_part('template-parts/archive-post-grid'); 
    endif;

?>
