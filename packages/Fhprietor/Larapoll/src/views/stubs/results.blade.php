@if(Session::has('errors'))
    <div class="alert alert-danger">
            {{ session('errors') }}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@if($seats > 0)
    <h3>{{ $question }}</h3>
    <h5>Metodo: Por cociente electoral</h5>
    <h6>Total participacion: {{ $total }}</h6>
    <h6>Abstenciones {{ $quorum-$total }}</h6>
    <h6>Escaños a repartir: {{$seats}} </h6>
    <h6>Cociente electoral: {{$quotient}}</h6>
    @foreach($options as $option)
        <div class='result-option-id'>
            <strong>{{ $option->name }}</strong>
            <div>Votos: {{ $option->votes }}</div>
            <div>Elegidos por cociente: {{ $option->seatsbyquotient }}</div>
            <div>Residuo: {{ $option->residue }}</div>
            <div class='progress'>
                <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='{{ $option->votes }}' aria-valuemin='0' aria-valuemax='100' style='width: {{ $option->percent }}%'>
                    <span class='sr-only'>{{ $option->votes }}% Completado</span>
                </div>
            </div>
        </div>
    @endforeach
@else
    <h3>Encuesta: {{ $question }}</h3>
    <h4>Votantes: {{ $users }}</h4>
    <h4>Total participación: {{ $total }}</h4>
    @if($quorum>0)
      <h4>Porcentaje participación: {{ round($total / $quorum,4) * 100 }}%</h4>
      <h4>Abstenciones: {{ $quorum-$total }}</h4>
    @endif
    @foreach($options as $option)
        <div class='result-option-id'>
            <strong>{{ $option->name }}</strong><span class='pull-right'>{{$option->votes}} votos ({{ $option->percent }}%)</span>
            <div class='progress'>
                <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='{{ $option->percent }}' aria-valuemin='0' aria-valuemax='100' style='width: {{ $option->percent }}%'>
                    <span class='sr-only'>{{ $option->percent }}% Completado</span>
                </div>
            </div>
        </div>
    @endforeach
@endif


