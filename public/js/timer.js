let second = 60;
let textTime = document.getElementById("time");

textTime.innerHTML = `Please wait within ${second}s to resend the code`;

const countDown = setInterval(() => {
    if (second > 0) {
        second--;
        textTime.innerHTML = `Please wait within ${second}s to resend the code`;
    } else {
        const id = document.getElementById("id").value;
        const role = document.getElementById("role").value;
        const el = `<a class="text-sm text-slate-900 text-right " id="resendCode" onclick="resendClick({{ $id }}, {{ $role }})" href="/resend-code/${id}/${role}">Resend code ? </a>`;
        document.getElementById("wrapResend").innerHTML = el;
        textTime.innerHTML = "";
        console.log(this.role);
        clearInterval(countDown);
    }
}, 1000);
