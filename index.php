<?php

require_once('SuggestionGenerator.php');

$generator = new SuggestionGenerator();

$suggestion = $generator->getSuggestion();

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>What The Fuck Should I Be For Halloween?</title>
        <style>
            * { margin: 0; }
            html, body { height: 100%; }
            body { text-align: center; font-family: Arial, Helvetica, sans-serif; }
            a:link, a:visited { color: blue; }
            h1,h2 { margin-bottom: 100px; }
            h1 { font-size: 60px; }
            h2 { font-size: 35px; padding-top: 100px; }
            #next { font-size: 25px; }
            #github { margin-left: 10px; }
            .wrapper {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -285px; /* the bottom margin is the negative value of the footer's height plus margin */
            }
            #costume { text-transform: uppercase; }
            #footer, #push {
                margin-top: 100px;
                height: 185px; /* .push must be the same height as .footer */
            }
            #footer { width: 100%; text-align: center; line-height: 30px; }
        </style>
    </head>
    <body>
        <!-- Facebook -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=140251516068779";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <!-- The actual content -->
        <div class='wrapper'>
            <h2 id='prompt'><?php echo $suggestion->prompt; ?>...</h2>
            <h1 id='costume'><?php echo $suggestion->costume; ?></h1>
            <a href='.' id='next' id='next' onClick="refresh(); return false;"><?php echo $suggestion->next; ?> Give me another idea.</a>
            <div id='push'></div>
        </div>


        <div id='footer'>
            <!-- Facebook -->
            <div class="fb-like" data-href="http://whatthefuckshouldibeforhalloween.com/" data-width="The pixel width of the plugin" data-height="The pixel height of the plugin" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>

            <!-- Github -->
            <iframe id='github' src="http://ghbtns.com/github-btn.html?user=captbaritone&repo=whatthefuckshouldibeforhalloween&type=fork&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="83" height="20"></iframe>


            <!-- Twitter -->
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://whatthefuckshouldibeforhalloween.com/" data-text="I'm going as a <?php echo $suggestion->costume; ?> for halloween thanks to">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

            <br />
            By: <a href='http://blog.classicalcode.com/'>Jordan</a> (<a href='https://twitter.com/captbaritone'>@captbaritone</a>)
            <br />
            Apologies to <a href='http://whatthefuckshouldimakefordinner.com' target='_blank'>whatthefuckshouldimakefordinner.com</a>
        </div>

        <!-- Google Analytics -->
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-96948-13']);
            _gaq.push(['_trackPageview']);

            (function() {
             var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
             ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
             var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
             })();

        </script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" charset="utf-8">

            // This will let us load future suggestions asynchronously in batches.
            // If js is not supported, it should fall back to simply reloading the page
            var suggestions = [];

            function getSuggestions() {
                $.getJSON( "api.php?count=10", function( data ) {
                    suggestions = suggestions.concat( data );
                });
            }

            // Grab some suggestions right away
            getSuggestions();

            function refresh() {
                // If we don't have any suggestions, wait
                if(suggestions.length == 0)
                {
                    setTimeout(refresh, 100);
                    return;
                }
                suggestion = suggestions.pop();
                $("#next").html( suggestion.next );
                $("#prompt").html( suggestion.prompt );
                $("#costume").html( suggestion.costume );
                _gaq.push(['_trackPageview']);

                if(suggestions.length < 5) getSuggestions();
            }
        </script>
    </body>
</html>
