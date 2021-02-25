@if(session("mensaje"))
<div class="alert alert-{{session('tipo') ? session("tipo") : "info"}}">
    {{session('mensaje')}}
</div>
@endif

@if(session("mensaje_n"))
<div class="alert_n">

</div>
@endif