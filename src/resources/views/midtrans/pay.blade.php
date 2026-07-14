<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Midtrans Payment</title>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ $clientKey }}">
    </script>
</head>

<body>

<script>

window.snap.pay('{{ $snapToken }}', {

    onSuccess: function(result){

        alert("Pembayaran Berhasil");

        window.location.href = "{{ auth()->user()?->hasRole('siswa') ? '/siswa/pembayarans' : (auth()->user()?->hasRole('orang_tua') ? '/orang-tua/pembayarans' : '/admin/pembayarans') }}";

    },

    onPending: function(result){

        alert("Menunggu Pembayaran");

        window.location.href = "{{ auth()->user()?->hasRole('siswa') ? '/siswa/pembayarans' : (auth()->user()?->hasRole('orang_tua') ? '/orang-tua/pembayarans' : '/admin/pembayarans') }}";

    },

    onError: function(result){

        alert("Pembayaran Gagal");

        window.location.href = "{{ auth()->user()?->hasRole('siswa') ? '/siswa/pembayarans' : (auth()->user()?->hasRole('orang_tua') ? '/orang-tua/pembayarans' : '/admin/pembayarans') }}";

    },

    onClose: function(){

        window.location.href = "{{ auth()->user()?->hasRole('siswa') ? '/siswa/pembayarans' : (auth()->user()?->hasRole('orang_tua') ? '/orang-tua/pembayarans' : '/admin/pembayarans') }}";

    }

});

</script>

</body>

</html>