
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>docs Api - khaled cars</title>
    <meta name="theme-color" content="#7952b3">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
  <body>
    <div class="row bg-light">
        <div class="col-3">
            <div class="d-flex flex-column p-3 text-white bg-dark" style="width: 280px;min-height: 100%;position: fixed;height: 100%;overflow: auto;">
                <a href="#home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-4">docs Api - khaled cars</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link" id='route-home'>
                            Home
                        </a>
                    </li>
                    <li>
                        @foreach ($docs['apis'] as $doc)
                            <a href="#{{$doc['name']}}" class="nav-link text-white" id='route-{{$doc['name']}}'>
                                ({{$loop->iteration}}) - {{$doc['name']}}
                            </a>
                        @endforeach
                    </li>
                </ul>
            <hr>
            </div>
        </div>
        <div class="col-9 api" style="min-height:1000px" id='home'>
            <div class="d-flex flex-column p-3 bg-light "  >
                <h3>description    </h3><span class='m-2'> {{$docs['description']}}</span><hr>
                <h3>baseUrl    </h3><span class='m-2'> {{$docs['baseUrl']}}</span><hr>
                <h3>json postman    </h3><span class='m-2'> <a href="/api/json_download">download collection</a></span><hr>

            </div>
        </div>

        @foreach ($docs['apis'] as $api)
            <div class="col-9 api" style=" min-height:1000px;margin-left: 25%" id="{{$api['name']}}">
                <h2>({{$loop->iteration}}) - {{$api['name']}}</h2>
                <div class="d-flex flex-column p-3 bg-light "  >
                    <h3>description    </h3><span class='m-2 fs-6 '> {{$api['description']}}</span><hr>
                    @if(isset($api['notes']))
                        <h3>notes    </h3><span class='m-2 fs-6 '> {!! $api['notes'] !!}</span><hr>
                    @endif
                </div>
                <div class="d-flex flex-column p-3 bg-light "  >
                    <h3> parameters </h3>
                    <table class="table table-striped mb-5 table-hover">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th >name</th>
                            <th >dataType</th>
                            <th >validation</th>
                            <th >description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($api['params'] as $param)
                                <tr>
                                    <td>{{$param['name']??'' }}</td>
                                    <td>{!! $param['dataType']?? '' !!}</td>
                                    <td>{{$param['validation']??''}}</td>
                                    <td>{!! $param['description']??'' !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column p-3 bg-light "  >
                    <h3> response</h3>
                    <table class="table table-striped mb-5 table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th >status</th>
                                <th >params</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($api['response'] as $response)
                                <tr>
                                    <td>{{$response['status']}}</td>
                                    <td>
                                        @foreach ($response['params'] as $key=>$val )
                                            <span class="d-block">({{$key}}) : {!! $val !!}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <hr style='border:10px solid #343a40;margin-top:150px' >
            </div>
        @endforeach
    </div>
    <div class="d-flex flex-column p-3 bg-light" style='margin-left:25%' >
        <h3> resources </h3>
        @foreach ($resources as $resource)
            <table class="table table-striped mb-5 table-hover" id="{{$resource['name']}}"  >
                <thead class="bg-primary text-white">
                    <tr class="bg-dark">
                        <th COLSPAN="4" col="3">
                           <H3><br>{{$resource['name']}}</H3>
                        </th>
                     </tr>
                <tr>
                    <th >name</th>
                    <th >dataType</th>
                    <th >validation</th>
                    <th >description</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($resource['params'] as $params)
                        <tr>
                            <td>{{$params['name']??'' }}</td>
                            <td>{!! $params['dataType']??'' !!}</td>
                            <td>{{$params['validation']??''}}</td>
                            <td>{!! $params['description']??'' !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr style='border:3px solid #343a40;margin-top:150px' >
        @endforeach
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    let navs = document.getElementsByClassName('nav-link');
    for(let i = 0; i < navs.length; i++) {
      navs[i].addEventListener("click", function() {
        document.getElementsByClassName('active')[0].classList.remove('active')
        navs[i].classList.add('active')
      })
    }
    var sections = {};

    $(".api").each(function(){
        var hash = $(this).attr('id'),
                topOffset = $(this).offset().top;
            sections[topOffset] = hash;
    });
    let hashName =window.location.hash;
    hashName= hashName== ""?'home' : hashName.replace('#','');
    if(document.getElementById(`route-${hashName}`))
        document.getElementById(`route-${hashName}`).classList.add('active');
    else
        document.getElementById(`route-home`).classList.add('active');
  </script>
</html>
