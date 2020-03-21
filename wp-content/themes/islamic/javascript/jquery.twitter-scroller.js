var $j = jQuery.noConflict();
//based on the tutorial located here http://andreaslagerkvist.com/archives/2011/06/24/how-to-create-a-scrolling-twitter-feed-using-jquery/
var Twitter = {
    init: function () {
        // Pass in the username you want to display feeds for
		var twitname=document.getElementById("twitname").innerHTML;
		
		this.insertLatestTweets(twitname);
    }, 

    // This replaces the <p>Loading...</p> with the tweets
    insertLatestTweets: function (username) {
		
        var limit    = 100;    // How many feeds do you want?
        var url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' + username + '&count=' + limit + '&callback=?';

        // Now ajax in the feeds from twitter.com
        $j.getJSON(url, function (data) {
            // We'll start by creating a normal marquee-element for the tweets
            var html = '<marquee behavior="scroll" scrollamount="1" direction="left">';

            // Loop through all the tweets and create a link for each
            for (var i in data) {
                html += '<a href="http://twitter.com/' + username + '#stream-item-tweet-' + data[i].id_str + '" target="_blank">' + data[i].text + '<i>' + Twitter.daysAgo(data[i].created_at) + '</i></a>';
            }

            html += '</marquee>';

            // Now replace the <p> with our <marquee>-element
            $j('#twitter p').replaceWith(html);
			
            // The marquee element looks quite shite so we'll use Remy Sharp's plug-in to replace it with a smooth one
            Twitter.fancyMarquee();
        });
    }, 

    // Replaces the marquee-element with a fancy one
    fancyMarquee: function () {
        // Replace the marquee and do some fancy stuff (taken from remy sharp's website)
        $j('#twitter marquee').marquee('pointer')
            .mouseover(function () {
                $j(this).trigger('stop');
            })
            .mouseout(function () {
                $j(this).trigger('start');
            })
            .mousemove(function (event) {
                if ($j(this).data('drag') == true) {
                    this.scrollLeft = $j(this).data('scrollX') + ($j(this).data('x') - event.clientX);
                }
            })
            .mousedown(function (event) {
                $j(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
            })
            .mouseup(function () {
                $j(this).data('drag', false);
            });
    }, 

    // Takes a date and return the number of days it's been since said date
    daysAgo: function (date) {
        // TODO: Fix date for IE...
        if ($j.browser.msie) {
            return '1 day ago';
        }

        var d = new Date(date).getTime();
        var n = new Date().getTime();

        var numDays = Math.round(Math.abs(n - d) / (1000 * 60 * 60 * 24));
        var daysAgo = numDays + ' days ago';

        if (numDays == 0) {
            daysAgo = 'today';
        }
        else if (numDays == 1) {
            daysAgo = numDays + ' day ago';
        }

        return daysAgo;
    }
};

Twitter.init();

/**
* author Remy Sharp
* url http://remysharp.com/2008/09/10/the-silky-smooth-marquee/
*/

(function ($) {
    $.fn.marquee = function (klass) {
        var newMarquee = [],
            last = this.length;

        // works out the left or right hand reset position, based on scroll
        // behavior, current direction and new direction
        function getReset(newDir, marqueeRedux, marqueeState) {
            var behavior = marqueeState.behavior, width = marqueeState.width, dir = marqueeState.dir;
            var r = 0;
            if (behavior == 'alternate') {
                r = newDir == 1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : width;
            } else if (behavior == 'slide') {
                if (newDir == -1) {
                    r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] : width;
                } else {
                    r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : 0;
                }
            } else {
                r = newDir == -1 ? marqueeRedux[marqueeState.widthAxis] : 0;
            }
            return r;
        }

        // single "thread" animation
        function animateMarquee() {
            var i = newMarquee.length,
                marqueeRedux = null,
                $marqueeRedux = null,
                marqueeState = {},
                newMarqueeList = [],
                hitedge = false;
                
            while (i--) {
                marqueeRedux = newMarquee[i];
                $marqueeRedux = $(marqueeRedux);
                marqueeState = $marqueeRedux.data('marqueeState');
                
                if ($marqueeRedux.data('paused') !== true) {
                    // TODO read scrollamount, dir, behavior, loops and last from data
                    marqueeRedux[marqueeState.axis] += (marqueeState.scrollamount * marqueeState.dir);

                    // only true if it's hit the end
                    hitedge = marqueeState.dir == -1 ? marqueeRedux[marqueeState.axis] <= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState) : marqueeRedux[marqueeState.axis] >= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                    
                    if ((marqueeState.behavior == 'scroll' && marqueeState.last == marqueeRedux[marqueeState.axis]) || (marqueeState.behavior == 'alternate' && hitedge && marqueeState.last != -1) || (marqueeState.behavior == 'slide' && hitedge && marqueeState.last != -1)) {                        
                        if (marqueeState.behavior == 'alternate') {
                            marqueeState.dir *= -1; // flip
                        }
                        marqueeState.last = -1;

                        $marqueeRedux.trigger('stop');

                        marqueeState.loops--;
                        if (marqueeState.loops === 0) {
                            if (marqueeState.behavior != 'slide') {
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                            } else {
                                // corrects the position
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                            }

                            $marqueeRedux.trigger('end');
                        } else {
                            // keep this marquee going
                            newMarqueeList.push(marqueeRedux);
                            $marqueeRedux.trigger('start');
                            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                        }
                    } else {
                        newMarqueeList.push(marqueeRedux);
                    }
                    marqueeState.last = marqueeRedux[marqueeState.axis];

                    // store updated state only if we ran an animation
                    $marqueeRedux.data('marqueeState', marqueeState);
                } else {
                    // even though it's paused, keep it in the list
                    newMarqueeList.push(marqueeRedux);                    
                }
            }

            newMarquee = newMarqueeList;
            
            if (newMarquee.length) {
                setTimeout(animateMarquee, 25);
            }            
        }
        
        // TODO consider whether using .html() in the wrapping process could lead to loosing predefined events...
        this.each(function (i) {
            var $marquee = $(this),
                width = $marquee.attr('width') || $marquee.width(),
                height = $marquee.attr('height') || $marquee.height(),
                $marqueeRedux = $marquee.after('<div ' + (klass ? 'class="' + klass + '" ' : '') + 'style="display: block-inline; width: ' + width + 'px; height: ' + height + 'px; overflow: hidden;"><div style="float: left; white-space: nowrap;">' + $marquee.html() + '</div></div>').next(),
                marqueeRedux = $marqueeRedux.get(0),
                hitedge = 0,
                direction = ($marquee.attr('direction') || 'left').toLowerCase(),
                marqueeState = {
                    dir : /down|right/.test(direction) ? -1 : 1,
                    axis : /left|right/.test(direction) ? 'scrollLeft' : 'scrollTop',
                    widthAxis : /left|right/.test(direction) ? 'scrollWidth' : 'scrollHeight',
                    last : -1,
                    loops : $marquee.attr('loop') || -1,
                    scrollamount : $marquee.attr('scrollamount') || this.scrollAmount || 2,
                    behavior : ($marquee.attr('behavior') || 'scroll').toLowerCase(),
                    width : /left|right/.test(direction) ? width : height
                };
            
            // corrects a bug in Firefox - the default loops for slide is -1
            if ($marquee.attr('loop') == -1 && marqueeState.behavior == 'slide') {
                marqueeState.loops = 1;
            }

            $marquee.remove();
            
            // add padding
            if (/left|right/.test(direction)) {
                $marqueeRedux.find('> div').css('padding', '0 ' + width + 'px');
            } else {
                $marqueeRedux.find('> div').css('padding', height + 'px 0');
            }
            
            // events
            $marqueeRedux.bind('stop', function () {
                $marqueeRedux.data('paused', true);
            }).bind('pause', function () {
                $marqueeRedux.data('paused', true);
            }).bind('start', function () {
                $marqueeRedux.data('paused', false);
            }).bind('unpause', function () {
                $marqueeRedux.data('paused', false);
            }).data('marqueeState', marqueeState); // finally: store the state
            
            // todo - rerender event allowing us to do an ajax hit and redraw the marquee

            newMarquee.push(marqueeRedux);

            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
            $marqueeRedux.trigger('start');
            
            // on the very last marquee, trigger the animation
            if (i+1 == last) {
                animateMarquee();
            }
        });            

        return $(newMarquee);
    };
}(jQuery));