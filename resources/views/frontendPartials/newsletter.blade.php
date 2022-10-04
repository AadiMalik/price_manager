<div class="newsletter">
    <div class="container">
        <div class="section-header">
            <h2>Subscribe Our Newsletter</h2>
        </div>
        <div class="form">
                            
            <form action="{{route('storeSubscribe')}}" method="POST" id="Subscribe">
                @csrf
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required="required" placeholder="Email here">
                
                <button class="btn" id="save">Submit</button>
                {!!$errors->first("email", "<span class='text-dark'>:message</span>")!!}
            </form>
        </div>
    </div>
</div>
{{--<script>
$(document).ready(function() {
$('#save).click(function() {
                    var email = $('#email').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('storeSubscribe')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            email: email
                        },

                        success: function(data) {
                            alert(data.success);
                        }
                    });

            });
            });
</script>--}}
