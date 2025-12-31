<!-- include the SDK -->
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>

<button id="payBtn">Pay Now</button>

<script>
document.getElementById('payBtn').addEventListener('click', async () => {
  try {
    // call backend to create order (replace route as needed)
    const res = await fetch('{{ url("/checkout/create-order") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        amount: 500,
        customer_email: 'gandushivkantg64@gmail.com',
        customer_phone: '7707479814'
      })
    });

    if (!res.ok) {
      const text = await res.text();
      console.error('Create order failed:', res.status, text);
      return alert('Order create failed: ' + res.status);
    }

    const data = await res.json();

    if (!data.success || !data.payment_session_id) {
      console.error('Unexpected create-order response:', data);
      return alert('Order creation failed on server');
    }

    // initialize Cashfree JS (mode must be 'sandbox' or 'production')
    const cashfree = Cashfree({ mode: 'sandbox' }); // or 'production'

    // start checkout using the payment_session_id from server
    cashfree.checkout({
      paymentSessionId: data.payment_session_id,
      redirectTarget: "_self" // or "_blank" or "_modal" based on your flow
    });

  } catch (err) {
    console.error('Error while creating order / starting checkout', err);
    alert('Something went wrong. Check console for details.');
  }
});
</script>
