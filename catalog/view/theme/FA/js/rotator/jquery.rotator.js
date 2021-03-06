/** Ротатор баннеров jquery.rotator.js
 *  http://biznesguide.ru/coding/152.html
 *  Copyright (c) 2011 Шамшур Иван (http://twitter.com/ivanshamshur)
 *  Dual licensed under the MIT and GPL licenses
 */
 
;(function($){
	
	
	var defaults = {
		slides: [
            			{url:'http://1popov.ru/c/577/disc1',img:'images/white200x450.jpg'},
            			{url:'http://1popov.ru/c/577/disc3',img:'images/beige200x450.jpg'},
            			{url:'http://1popov.ru/c/577/disc5',img:'images/sky200x450.jpg'},
            			{url:'http://1popov.ru/c/577/disc6',img:'images/gold200x450.jpg'},
            			{url:'http://1popov.ru/c/577/disc8',img:'images/green200x450.jpg'},
            			{url:'http://1popov.ru/c/577/disc11',img:'images/black200x450.jpg'}
            		],
		speed: 500,
		timeout: 3000,
		width: '100%',
		height: 600,
		random: true, 
		autorun: true,
		fx: 'fade',
		nav: false			
	};
	
	
	$.rotator = function(e, o) {
		
		this.options = $.extend({}, defaults, o || {});
		
		this.el = $(e);
        this.step = -1;
        this.current = 0;
        this.previous = 0;
        this.animating = false;
        this.intervalID = null;
		
		this.nav_left = $('<a href="javascript:void(0);" class="rotator-nav" id="rotator-left"><div></div></a>');
		this.nav_right = $('<a href="javascript:void(0);" class="rotator-nav" id="rotator-right"><div></div></a>');
		this.preloader = $('<div class="preloader_rotator"></div>');
		this.main_rotator = $('<div class="main_rotator"></div>');
		this.slides_rotator = $('<ul class="slides_rotator"></ul>');
		
		this.count = this.options.slides.length - 1;
       
		this.init();
					
	};
	
	
	var $r = $.rotator;

	$r.fn = $r.prototype = {
        rotator: '0.1'
    };
	
	$r.fn.extend = $r.extend = $.extend;

    $r.fn.extend({
    	
    	init: function(){

    		this.preload();
            
            var self = this;
            
            this.nav_left.bind('click.rotator',function(){
                
				self.prev();
			});
			
			this.nav_right.bind('click.rotator',function(){

				self.next();
			});
    		
    	},
        add: function(slides){
            
            if(slides.length == 0) return false;
            
            var render = [], self = this;
	    	
            
            this.count += slides.length-1;
           
	    	$.each(slides,function(i,slide){
	    		
	    		render.push('<li><div class="img_rotator"><a rel="nofollow" href="'+slide.url+'" target="_parent _blank"><img src="'+slide.img+'" width="'+self.options.width+'"  alt="*" /></a></div></li>');
	    	});

	    	this.slides_rotator
            .append(render.join(''))
            .find('li')
            .css({'position': 'absolute','z-index': 1,'left':this.options.width});
            
        },
    	preload: function(){
    		
    		//Индикатор загрузки
	    	this.el.html(this.preloader.append('<img src="images/ajax-loader.gif" width="32" alt="Загрузка..." />'));               		    	
	        var loaded = 0,pic = [],self = this;
            
            //Добавляем html-разметку слайдов    
            this.slides = this.render().find('li').css({'position': 'absolute','z-index': 1});

            this.main_rotator.css({display: 'none'});
            this.slides_rotator.css({width:'100%',height:this.options.height}); 
            
	        if(this.options.fx == 'fade'){

	    		//Скрываем все слайды, кроме первого
		        this.slides.css('opacity',0).eq(0).css({'z-index': 2,'opacity':1});
	    	}
	    	else{

	    		this.slides_rotator.css('overflow','hidden'); 
                
	    		//Задаем начальную позицию слайдам
		        this.slides.css('left',this.options.width).eq(0).css({'z-index': 2,'left':0});

             }
             
             //Когда все изображения слайдов загрузятся
	        //прячем индикатор загрузки и выводим первый слайд
	        for (i=0; i <= this.count; i++) {
	           
	           pic[i] = new Image();
               
               pic[i].onload = function() {

	                loaded++;

                    //Когда все картинки загружены
                    //прячем индикатор загрузки и выводим слайды
	                if(loaded >= self.count){
	                   
	                	self.main_rotator.show();
                        $('.rotator-nav').show();
	                	self.preloader.hide();
	                    
	                	if(self.options.autorun){
	                		
	                		self.start();
	                	}
	                    
	                }
	            };
                
                pic[i].src = this.options.slides[i].img;
	        }
		},
		render: function(){
	    	
            this.el.append(this.main_rotator);
    				
            if(this.options.nav){
                
                this.el.append(this.nav_left,this.nav_right);
                
                $('.rotator-nav').hide();
            }
            
	        //Перемешиваем слайды
            if(this.options.random){
                
                this.options.slides.sort(function() {return 0.5 - Math.random()});
            }
	    	
	        
	    	var render = [], self = this;
	    	
	    	$.each(this.options.slides,function(i,slide){
	    		
	    		render.push('<li><div class="img_rotator"><a rel="nofollow" href="'+slide.url+'" target="_parent _blank"><img src="'+slide.img+'" width="100%" height="'+self.options.height+'" alt="*" /></a></div></li>');
	    	});

	    	return this.slides_rotator.html(render.join('')).appendTo(this.main_rotator);

	    },
        start: function(){
            var self = this;
            this.step = -1; 
	    	this.intervalID = setInterval(function(){self.next();},this.options.timeout);   	
	    },
        stop: function(){
            
            clearInterval(this.intervalID);    	        
        },
        next: function(){
            
            if(this.animating) return false;
            
            this.step = -1;  
            	    	     
	    	if(this.current >= this.count) this.current = -1;
	
	    	this.previous = this.current;
	    	this.current++;
	
	    	if(this.current == 0) this.previous = this.count;
	    	
	    	this.run();

	    },
        prev: function(){
            
            if(this.animating) return false;
            
            this.step = 1;
	    	this.previous = this.current;
	    	this.current--;
	
	    	if(this.current < 0) this.current = this.count;
        	
        	this.run();
        },
        run: function(){

            var self = this;
            
            this.animating = true; //начало анимации
            
            if(this.options.autorun) this.stop();
				
        	if(this.options.fx == 'fade'){

                this.slides.eq(this.previous)
                .css('z-index',1)
                .stop(true,true)
                .animate({'opacity': 0},this.options.speed);  
                                    
        		this.slides.eq(this.current)
                .css('z-index',2)
                .stop(true,true)
                .animate({'opacity': 1},this.options.speed,function(){                    
                    self.animating = false; //конец анимации
                });  
        	}
        	else{

                this.slides.eq(this.previous)
                .css('z-index',1)
                .stop(true,true)
                .animate({'left': this.step*this.options.width},this.options.speed,function(){
                    
                    $(this).css('left',this.step*self.options.width);

                });
                
                var sc = this.slides.eq(this.current);

                if(sc.css('left').match(/([-\d]+)/)[1] != -this.step*this.options.width){
                    
                    sc.css('left',-this.step*this.options.width);
                }
                
                sc.css({'z-index':2}).stop(true,true).animate({'left': 0},this.options.speed,function(){
                    
                    self.animating = false; //конец анимации
                    
                });
        	}
            
            if(this.options.autorun) this.start();
        }
    	
    });
    
    $.fn.rotator = function(o){
    	
    	if (typeof o == 'string') {
            var instance = $(this).data('rotator'), args = Array.prototype.slice.call(arguments, 1);
            return instance[o].apply(instance, args);
        } else {
            return this.each(function() {
                var instance = $(this).data('rotator');
                if (instance) {
                    if (o) {
                        $.extend(instance.options, o);
                    }
                    
                    instance.init();
                    
                } else {
                	
                    $(this).data('rotator', new $r(this, o));
                }
            });
        }
    };   
})(jQuery);