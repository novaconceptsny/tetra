@extends('layouts.master')

@section('content')
    <div class="dashboard mini">
        <div class="image__viewer">
            @if ($tracker==1)
                <div id="tracker"
                     style="position:fixed;right:70px;top:0px;width:300px;height:150px;background-color:red;z-index:1000;padding:10px">
                </div>
            @endif
            <div class="featured__img" id="pano" >
                <noscript>
                    <table style="width:100%;height:100%;">
                        <tr style="vertical-align:middle;">
                            <td>
                                <div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div>
                            </td>
                        </tr>
                    </table>
                </noscript>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset("krpano/tour.js") }}"></script>

    <script type="text/javascript">
        let krpano = null;
        let hlookat = {{$hlookat}};
        let vlookat = {{$vlookat}};
        let shareType = {{$shareType}};
        let hash = "{{$hash}}";
        let spotId = {{$spotId}};
        let timestamp = Date.now();

        let tracker = {{$tracker}};


        console.log("timestamp:" + timestamp);

        embedpano({
            xml: '{{ asset($xmlPath) }}' + '?' + timestamp,
            target: "pano",
            html5: "only",
            passQueryParameters: true,
            mobilescale: 1.0,
            onready: krpano_onready_callback,
            initvars: {
                timestamp: timestamp,
                showerrors: false,
                spot_id: {{$spotId}},
                shareType: {{$shareType}},


                @foreach ($surfaces as $surface)
                {{ "wall_{$surface->state->id}"}}: '{{ asset($surface->state->url) }}',
                @endforeach
            },
        });

        // let krpano = document.getElementById("krpanoSWFObject");
        function krpano_onready_callback(krpano_interface) {
            krpano = krpano_interface;
        }


        function setHVLookat(hlookat, vlookat) {
            if (hlookat != 0 || vlookat != 0) {
                console.log('in');
                krpano.call("set(view.hlookat," + hlookat + ")");
                krpano.call("set(view.vlookat," + vlookat + ")");
            }
        }


        function krpano_onready_callback(krpano_interface) {
            krpano = krpano_interface;
        }

        let track_mouse_enabled = false;
        let track_mouse_interval_id = null;

        function track_mouse_interval_callback() {
            let mx = krpano.get("mouse.x");
            let my = krpano.get("mouse.y");
            let pnt = krpano.screentosphere(mx, my);
            let h = pnt.x;
            let v = pnt.y;
            let str = 'x="' + mx + '" y="' + my + '"<BR><BR>ath="' + h.toFixed(2) + '" atv="' + v.toFixed(2) + '"';

            let hlookat = krpano.get("view.hlookat").toFixed(2);
            let vlookat = krpano.get("view.vlookat").toFixed(2);
            let fov = krpano.get("view.fov").toFixed(2);
            let str2 = '<BR><BR> hlookat:' + hlookat + ', vlookat:' + vlookat + ', fov:' + fov;
            $("#tracker").html(str + str2);
        }

        function track_mouse() {
            if (krpano) {
                if (track_mouse_enabled == false) {
                    // enable - call 60 times per second
                    track_mouse_interval_id = setInterval(track_mouse_interval_callback, 1000.0 / 60.0);
                    track_mouse_enabled = true;
                } else {
                    // disable
                    clearInterval(track_mouse_interval_id);
                    $("#tracker").html("");
                    track_mouse_enabled = false;
                }
            }
        }

        if (tracker == 1) {
            track_mouse();
        }

        krpano.call("set(layer['version'].onclick,openurl('/version/management/spot/{{$spotId}}'))");

    </script>
@endsection