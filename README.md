composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
  $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->integer('role_id')->comment('1=admin, 2 =sales manager')->default(2);
            $table->rememberToken();
            $table->timestamps();
php artisan migrate
php artisan make:seeder AdminSeeder
 $data = [
            'name'=>'Admin',
            'email'=>'smferoj27@gmail.com',
            'phone'=>'01724603800',
            'password'=>Hash::make('12345678'),
            'role_id'=>1
        ];

        User::create($data);

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role_id',
        'password',
    ];

php artisan db:seed AdminSeeder
php artisan make:controller AuthController
php artisan make:request AuthRequest
 
 public function authorize(): bool
    {
        return true; (modification)
    }

  public function rules(): array
    {
        return [
            'email'=>'required|max:50',
            'password'=>'required|max:50',
        ];
    }

    
php artisan optimize
php artisan config:clear
php artisan cache:clear
php artisan serve

