<form id="paymentForm">
    @csrf
    <input type="text" name="name" id="name" placeholder="Name">
    <input type="email" name="email"  id="email" placeholder="Email">
    <input type="text" name="phone" id="phone" placeholder="Phone">
    <input type="number" name="amount" id="amount" placeholder="Amount">
  
    <button type="button" onclick="payNow()">Pay Now</button>
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    // document.addEventListener('DOMContentLoaded',function(){
    //      document.getElementById('btn').addEventListener('click' ,function(){
    //        
    //         console.log('hello');
    //      });
    // });
function payNow() {
    
    let formData = new FormData(document.getElementById('paymentForm'));
    

        
    

    fetch("{{ route('pay') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        var options = {
            "key": "{{ config('razorpay.key') }}",
            "amount": data.amount * 100,
            "currency": "INR",
            "name": "Test Payment",
            "order_id": data.order_id,
            "handler": function (response) {
                fetch("{{ route('payment.success') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        name: data.name,
                        email: data.email,
                        phone: data.phone,
                        amount: data.amount
                    })
                });
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    });

}
</script>
