LARAVUE-BLOG Set-up

1. Set up laravel and vue with vite in a single folder
    - Create a laravel
    - Go to terminal, npm vue@next
    - On app.js, 
        - import {createApp} from 'vue';
        - createApp(App).mount('#app')
        - add a App.vue on js folder
        - import App from '../js/App.vue'
    - Go to terminal, npm install
    - Go to terminal, npm install @vitejs/plugin-vue
    - On vite.config.js
        - import vue from '@vitejs/plugin-vue';
        - on plugins add; vue()
        - remove resources/css/app.css
    - On welcome.blade,
        - delete all in the body
        - add  <div id=app></div> in the body
        - add @vite('resources/js/app.js') in the head
    -Go to terminal, npm run dev to execute the code

2. Login and Register
    - Connect your database in the env change the necessary details

    <!-- Registration -->
    - Access database\migration\user table
        - add a  $table->string('password_confirmation')->nullable();
    - Go to terminal, php artisan migrate
    - Go to app\models\user.php
        - add in protected fillable the password_confirmation
    - Go to terminal, php artisan make:controller RegisterController
        - add use app\model\user on top
    - Create a public function store
         $request->validate
            'name'=> 'required|string|max:150',
            'email'=> 'required|email|unique:users' .auth()->id(),
            'password' => 'required|confirmed',
            'password_confirmation' => 'required', 
            <!-- This code will be use to validate the data that the user will input -->
          User::create
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt ( $request->password ),
            'password_confirmation' => bcrypt ( $request->password_confirmation ),
            <!-- After validation, this code will be used to create a data in the database -->
          return response()->json
             <!-- This will push the data as a json format -->
    - Go to routes\api.php
        - add the controller on top use app\Http\Controllers\RegisterController
        - create a post route and name the function store and the URL /register
    - Test the API in thunderclient/Postman

    <!-- LOG IN -->
    - Go to terminal, php artisan make:controller LoginController
        - Create a public function check
         $credentials= $request->validate
            'email'=> 'required|email',
            'password' => 'required',
            <!-- This code will be use to validate the data that the user will input -->
        if (Auth::attempt($credentials)) 
            {
            return response()->json([ 'status' => true ,
            'message' => 'log in successfully',
            ]);
            }
                return response()->json(['status' => false ,
                'message' => 'invalid credentials',],401);
            <!-- This code will validate the user input whether its true or false and returns as a json -->
    - Go to routes\api.php
        - add the controller on top use app\Http\Controllers\LoginController
        - create a post route and name the function check and the URL /login  
    - Test the API in thunderclient/Postman
