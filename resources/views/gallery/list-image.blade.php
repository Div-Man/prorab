@extends('layouts.app')
@section('content')

<h2 class="title-masters"> {{$category}}</h2>

 <div id="links" class="links">
              <div class="photo"> 
			  
			  <!-- с атрибутом 
			  
			  data-gallery="">< 
			  
			  не будет появляться дата атрибуты
			  
			  -->
			
	
                  @foreach($images as $image)
                  <a href="/{{$image->image}}" title="{{$image->title}}" data-userId="{{$image->user_id}}" data-author="{{$image->name}}" ><img src="/{{$image->image}}" width="200"></a>    
                        
                    @endforeach
              </div>
              </div>

    
    
     <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <div class="author-wrap">Мастер: 
            <a class="author" target="_blank" href=""></a>
        </div>
        
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>


 <script src="/js/blueimp-helper.js"></script>
        <script src="/js/blueimp-gallery.js"></script>
        <script src="/js/blueimp-gallery-fullscreen.js"></script>
        <script src="/js/blueimp-gallery-indicator.js"></script>
        <script src="/js/vendor/jquery.js"></script>
        <script src="/js/jquery.blueimp-gallery.js"></script>
        
        
       
 <script>
    document.getElementById('links').onclick = function (event) {
  event = event || window.event;
  var target = event.target || event.srcElement,
    link = target.src ? target.parentNode : target,
    options = {
      index: link, event: event,
      onslide: function (index, slide) {

        self = this;
        var initializeAdditional = function (index, data, data2, klass, self) {
             
          var text = self.list[index].getAttribute(data),
            text2 = self.list[index].getAttribute(data2),
            node = self.container.find(klass);
            node.empty();
          
          if (text) {
            node[0].appendChild(document.createTextNode(text));
            node[0].setAttribute('href', '/masters/profile/' + text2);
           
           ;
          }
        };
        initializeAdditional(index, 'data-author', 'data-userId', '.author', self);
        //initializeAdditional(index, 'data-userId', '.userId', self);
      }
    },
    links = this.getElementsByTagName('a');
  blueimp.Gallery(links, options);
};
        </script>
 

@endsection