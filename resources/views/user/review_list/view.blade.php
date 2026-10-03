<div class="container rounded bg-white ">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3">
                <img class="rounded-circle" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">{{$ReviewForm->customer_name}}</span>
                {{-- <span class="text-black-50">edogaru@mail.com.my</span> --}}
                <p>
                    @for ($i = 0; $i < $ReviewForm->rating; $i++)
                     <span> <i class="ti ti-star fs-4 favourite-note" style="color: gold;"></i></span>
                @endfor
                </p>
                
               
            </div>
        </div>
        <div class="col-md-9 border-right">
            <div class="p-3 ">

                <div class="row mt-2">

                    @foreach ($ReviewFormField as $item)
                        <div class="col-md-6">
                            <label class="labels">{{$item->key}}</label>
                           <h3>
                            {{$item->value}}
                           </h3>
                        </div>
                    @endforeach
                    

                 
                    
                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>