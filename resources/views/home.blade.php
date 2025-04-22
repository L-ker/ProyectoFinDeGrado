<x-layouts.layout >
<div class="w-full h-75v md:h-[65vh] relative">
  <div class="carousel w-full h-full">
    <div id="slide1" class="carousel-item relative w-full h-full">
      <img src="{{ asset('images/hotel1.jpg') }}" alt="{{__('imagenJuego1')}}" class="w-full h-full object-cover" />
      <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between z-20">
        <a href="#slide4" class="btn btn-circle">❮</a>
        <a href="#slide2" class="btn btn-circle">❯</a>
      </div>
    </div>

    <div id="slide2" class="carousel-item relative w-full h-full">
      <img src="{{ asset('images/hotel2.jpg') }}" alt="{{__('imagenJuego2')}}" class="w-full h-full object-cover" />
      <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between z-20">
        <a href="#slide1" class="btn btn-circle">❮</a>
        <a href="#slide3" class="btn btn-circle">❯</a>
      </div>
    </div>

    <div id="slide3" class="carousel-item relative w-full h-full">
      <img src="{{ asset('images/hotel3.jpg') }}" alt="{{__('imagenJuego3')}}" class="w-full h-full object-cover" />
      <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between z-20">
        <a href="#slide2" class="btn btn-circle">❮</a>
        <a href="#slide4" class="btn btn-circle">❯</a>
      </div>
    </div>

    <div id="slide4" class="carousel-item relative w-full h-full">
      <img src="{{ asset('images/hotel4.jpg') }}" alt="{{__('imagenJuego4')}}" class="w-full h-full object-cover" />
      <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between z-20">
        <a href="#slide3" class="btn btn-circle">❮</a>
        <a href="#slide1" class="btn btn-circle">❯</a>
      </div>
    </div>
  </div>

  <!-- Texto sobre todas las imágenes -->
  <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black/50 text-white text-4xl font-bold pointer-events-none">
  {{__("PAGINA DE GESTION DE USUARIOS DEL JUEGO Y PUNTUACIONES")}}
  </div>
</div>

</x-layouts.layout>
