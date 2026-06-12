<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    User Login
                </div>

                <div class="card-body">

                    <div id="message"></div>

                    <form id="loginForm">

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                id="email"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                id="password"
                                class="form-control">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            Login

                        </button>

                        <a href="registration.php" class="btn btn-danger">
    Register
</a>
 
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document
.getElementById('loginForm')
.addEventListener(
'submit',
async function(e){

e.preventDefault();

const response =
await fetch(
'../api/login.php',
{
method:'POST',

headers:{
'Content-Type':
'application/json'
},

body:JSON.stringify({

email:
document.getElementById('email').value,

password:
document.getElementById('password').value

})

});

const result =
await response.json();

if(result.status)
{
    window.location =
    'dashboard.php';
}
else
{
    document
    .getElementById('message')
    .innerHTML =
    `<div class="alert alert-danger">
    ${result.message}
    </div>`;
}

});

</script>

</body>
</html>