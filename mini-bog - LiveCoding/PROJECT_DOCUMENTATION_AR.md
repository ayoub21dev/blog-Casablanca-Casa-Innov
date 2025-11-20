# 📚 شرح المشروع - مدونة Casa Innov

---

## 🎯 نظرة عامة على المشروع

هذا المشروع عبارة عن **تطبيق مدونة** بني باستخدام إطار عمل Laravel. يسمح للمستخدمين بإنشاء المقالات وتصنيفها وإضافة الوسوم (Tags) لها.

---

## 📁 شرح الفولدرات الرئيسية

```
المشروع/
├── app/                 → كود التطبيق الأساسي
├── database/            → قاعدة البيانات والبيانات الأولية
├── resources/           → الملفات الثابتة (CSS, JS, Views)
├── routes/              → المسارات والروابط
├── storage/             → التخزين المؤقت والملفات
├── vendor/              → مكتبات الطرف الثالث
└── tests/               → الاختبارات
```

---

## 🗄️ قاعدة البيانات والجداول

### الجداول الرئيسية:

#### 1️⃣ **جدول Users (المستخدمون)**
```
users
├── id (المعرّف الفريد)
├── name (الاسم)
├── email (البريد الإلكتروني)
├── password (كلمة المرور - مشفرة)
├── email_verified_at (تاريخ التحقق من البريد)
├── remember_token
├── created_at
└── updated_at
```

#### 2️⃣ **جدول Articles (المقالات)**
```
articles
├── id (المعرّف الفريد)
├── title (العنوان)
├── slug (النص المختصر للرابط)
├── excerpt (الملخص القصير)
├── content (محتوى المقالة)
├── user_id (معرّف المستخدم - المؤلف)
├── category_id (معرّف الفئة)
├── status (حالة المقالة: مسودة، منشورة، إلخ)
├── created_at
└── updated_at
```

#### 3️⃣ **جدول Categories (الفئات/التصنيفات)**
```
categories
├── id (المعرّف الفريد)
├── name (اسم الفئة)
├── slug (النص المختصر للرابط)
├── description (الوصف)
├── created_at
└── updated_at
```

#### 4️⃣ **جدول Tags (الوسوم)**
```
tags
├── id (المعرّف الفريد)
├── name (اسم الوسم)
├── slug (النص المختصر للرابط)
├── created_at
└── updated_at
```

#### 5️⃣ **جدول article_tag (العلاقة بين المقالات والوسوم)**
```
article_tag (جدول وسيط)
├── id (المعرّف الفريد)
├── article_id (معرّف المقالة)
├── tag_id (معرّف الوسم)
```

---

## 🔗 العلاقات بين الجداول

```
┌─────────────┐
│   Users     │
└──────┬──────┘
       │ (1 مستخدم : عديد المقالات)
       │
       ↓
┌─────────────────┐
│   Articles      │
└──────┬────┬─────┘
       │    │
       │    │ (1 فئة : عديد المقالات)
       │    └──────────────→ Categories
       │
       │ (عديد المقالات : عديد الوسوم)
       └──────────────↓─────────→ Tags
                     │
                  article_tag
                  (جدول وسيط)
```

### شرح العلاقات:

1. **المستخدم والمقالات**: مستخدم واحد يمكنه كتابة عديد المقالات
2. **المقالة والفئة**: مقالة واحدة تنتمي إلى فئة واحدة فقط
3. **المقالة والوسوم**: مقالة واحدة يمكن أن تحتوي على عديد الوسوم، والوسم الواحد يمكن أن يكون في عديد المقالات (علاقة Many-to-Many)

---

## 📦 ملفات الـ Models (النماذج)

### 📄 `app/Models/User.php`
```php
class User extends Authenticatable {
    use HasFactory;
    
    // العلاقات:
    public function articles() {
        return $this->hasMany(Article::class);
    }
}
```
- **الدور**: تمثيل جدول المستخدمين
- **العلاقات**: له عديد المقالات (One-to-Many)

---

### 📄 `app/Models/Article.php`
```php
class Article extends Model {
    use HasFactory;
    
    protected $fillable = [
        'title', 'content', 'slug', 
        'excerpt', 'user_id', 
        'category_id', 'status'
    ];
    
    // العلاقات:
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
```
- **الدور**: تمثيل جدول المقالات
- **العلاقات**: 
  - تنتمي إلى مستخدم واحد (Belongs-To-One)
  - تنتمي إلى فئة واحدة (Belongs-To-One)
  - تحتوي على عديد الوسوم (Many-to-Many)

---

### 📄 `app/Models/Category.php`
```php
class Category extends Model {
    // العلاقات:
    public function articles() {
        return $this->hasMany(Article::class);
    }
}
```
- **الدور**: تمثيل جدول الفئات
- **العلاقات**: لها عديد المقالات (One-to-Many)

---

### 📄 `app/Models/Tag.php`
```php
class Tag extends Model {
    // العلاقات:
    public function articles() {
        return $this->belongsToMany(Article::class);
    }
}
```
- **الدور**: تمثيل جدول الوسوم
- **العلاقات**: لها عديد المقالات (Many-to-Many)

---

## 🏭 ملفات الـ Factories (مصانع البيانات)

### 📄 `database/factories/UserFactory.php`
```php
class UserFactory extends Factory {
    public function definition(): array {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
        ];
    }
}
```
- **الدور**: توليد بيانات وهمية للمستخدمين
- **الاستخدام**: للاختبارات والتطوير

---

### 📄 `database/factories/ArticleFactory.php`
```php
class ArticleFactory extends Factory {
    public function definition(): array {
        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->text(100),
            'slug' => $this->faker->unique()->slug(),
            'user_id' => User::factory(),  // إنشاء مستخدم تلقائياً
        ];
    }
}
```
- **الدور**: توليد بيانات وهمية للمقالات
- **الميزة**: ينشئ مستخدماً تلقائياً لكل مقالة

---

### 📄 `database/factories/TagFactory.php`
```php
class TagFactory extends Factory {
    public function definition(): array {
        return [
            'name' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->slug(),
        ];
    }
}
```
- **الدور**: توليد بيانات وهمية للوسوم

---

## 🔧 ملفات الـ Services (الخدمات)

### 📄 `app/Services/ArticleService.php`
```php
class ArticleService {
    
    // الحصول على جميع المقالات مع التصفية
    public function getAllArticles(
        array $filters = [], 
        int $perPage = 10
    ): LengthAwarePaginator {
        $query = Article::with('category')->latest();
        
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        return $query->paginate($perPage);
    }
    
    // حذف مقالة
    public function deleteArticle(int $id): bool {
        $article = Article::find($id);
        if (!$article) return false;
        return $article->delete();
    }
    
    // الحصول على جميع الفئات
    public function getAllCategories() {
        return Category::all();
    }
}
```

**الدور**: معالجة منطق العمل (Business Logic)
- ✅ استرجاع المقالات
- ✅ تصفية المقالات حسب الفئة
- ✅ حذف المقالات
- ✅ استرجاع الفئات

---

## 📋 ملفات الـ Migrations (الهجرات - إنشاء الجداول)

### 📄 `database/migrations/2025_11_05_111405_create_articles_table.php`
```php
public function up(): void {
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->text('excerpt')->nullable();
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');
        $table->timestamps();
    });
}
```
- **الدور**: إنشاء جدول المقالات في قاعدة البيانات

---

### 📄 `database/migrations/2025_11_05_111720_create_tags_table.php`
- **الدور**: إنشاء جدول الوسوم

---

### 📄 `database/migrations/2025_11_05_111918_create_article_tag_table.php`
- **الدور**: إنشاء جدول العلاقة بين المقالات والوسوم

---

### 📄 `database/migrations/2025_11_20_093035_create_categories_table.php`
- **الدور**: إنشاء جدول الفئات

---

### 📄 `database/migrations/2025_11_20_093234_add_category_and_status_to_articles_table.php`
```php
public function up(): void {
    Schema::table('articles', function (Blueprint $table) {
        $table->foreignId('category_id')
              ->nullable()
              ->constrained()
              ->onDelete('set null');
        $table->string('status')
              ->default('draft');
    });
}
```
- **الدور**: إضافة عمود الفئة وحالة المقالة

---

## 🌱 ملفات الـ Seeders (البذور - البيانات الأولية)

### 📄 `database/seeders/DatabaseSeeder.php`
```php
public function run(): void {
    // إنشاء 10 مستخدمين
    User::factory(10)->create();
    
    // إنشاء 5 فئات
    Category::factory(5)->create();
    
    // إنشاء 20 مقالة
    Article::factory(20)->create();
    
    // إنشاء 10 وسوم
    Tag::factory(10)->create();
    
    // ربط المقالات بالوسوم بشكل عشوائي
    Article::all()->each(function ($article) {
        $article->tags()->attach(
            Tag::inRandomOrder()->limit(3)->pluck('id')
        );
    });
}
```

- **الدور**: ملء قاعدة البيانات بـ بيانات وهمية للاختبار

---

## 🌐 المسارات والتحكم - Routes

### 📄 `routes/web.php`
```php
Route::get('/', function () {
    // عرض جميع المقالات
});

Route::resource('articles', ArticleController::class);
// Routes المتاحة:
// GET  /articles              - عرض جميع المقالات
// POST /articles              - إنشاء مقالة جديدة
// GET  /articles/{id}         - عرض مقالة واحدة
// PUT  /articles/{id}         - تحديث مقالة
// DELETE /articles/{id}       - حذف مقالة
```

---

## 👁️ ملفات الـ Views (العروض)

### 📄 `resources/views/welcome.blade.php`
- الصفحة الرئيسية

### 📁 `resources/views/Articles/`
- عرض قائمة المقالات
- عرض مقالة واحدة
- نموذج إنشاء مقالة جديدة

### 📁 `resources/views/layouts/`
- القالب الأساسي للموقع

---

## 🔄 سير العمل الكامل - Complete Workflow

### 1️⃣ **عملية إنشاء مقالة جديدة**:
```
المستخدم يملأ النموذج
        ↓
Controller يستقبل البيانات
        ↓
Service يتحقق من البيانات
        ↓
Model ينشئ سجل في جدول Articles
        ↓
تتم إضافة علاقة مع User و Category
        ↓
قاعدة البيانات تحفظ البيانات
        ↓
عرض رسالة النجاح للمستخدم
```

---

### 2️⃣ **عملية عرض المقالات**:
```
المستخدم يطلب الصفحة الرئيسية
        ↓
Controller يستدعي Service
        ↓
Service تستخدم Model للبحث عن المقالات
        ↓
Model تحصل على البيانات من قاعدة البيانات
        ↓
تحميل العلاقات: User، Category، Tags
        ↓
تصفية حسب الفئة إن وجدت
        ↓
تقسيم النتائج إلى صفحات (Pagination)
        ↓
عرض النتائج في View
```

---

### 3️⃣ **عملية البحث والتصفية**:
```
المستخدم يختار فئة
        ↓
طلب يُرسل مع معامل category_id
        ↓
Service::getAllArticles($filters)
        ↓
Model تصفي البيانات حسب category_id
        ↓
عرض المقالات المصفاة فقط
```

---

## 💾 العلاقات في الكود

### مثال على استخدام العلاقات:
```php
// الحصول على مقالة مع مؤلفها
$article = Article::with('user')->find(1);
echo $article->user->name;  // اسم المؤلف

// الحصول على جميع مقالات مستخدم معين
$user = User::find(1);
$articles = $user->articles;

// الحصول على مقالة مع جميع وسوماها
$article = Article::with('tags')->find(1);
foreach ($article->tags as $tag) {
    echo $tag->name;
}
```

---

## 🚀 خطوات تشغيل المشروع

### 1. تثبيت المتطلبات:
```bash
composer install
npm install
```

### 2. إنشاء قاعدة البيانات:
```bash
php artisan migrate
```

### 3. ملء البيانات الأولية:
```bash
php artisan db:seed
```

### 4. أو القيام بكل شيء مرة واحدة:
```bash
php artisan migrate:fresh --seed
```

### 5. تشغيل الخادم:
```bash
php artisan serve
```

---

## 📊 مخطط شامل للمشروع

```
┌──────────────────────────────────────────────────────┐
│                  مقدمة الطلب (Request)                 │
│                  من المتصفح                          │
└────────────────────┬─────────────────────────────────┘
                     │
                     ↓
        ┌───────────────────────┐
        │   Router / Routes     │
        │ توجيه الطلب للتحكم   │
        └───────────┬───────────┘
                    │
                    ↓
        ┌─────────────────────┐
        │  Controller         │
        │ معالجة الطلب       │
        └─────────┬───────────┘
                  │
                  ↓
        ┌──────────────────────────┐
        │   Service                │
        │  معالجة منطق العمل      │
        └─────────────┬────────────┘
                      │
                      ↓
            ┌─────────────────────┐
            │   Model / Eloquent  │
            │ التواصل مع قاعدة    │
            │      البيانات       │
            └────────┬────────────┘
                     │
                     ↓
        ┌───────────────────────────┐
        │    قاعدة البيانات        │
        │   (Database / Tables)     │
        │                           │
        │ ├─ Users                 │
        │ ├─ Articles              │
        │ ├─ Categories            │
        │ ├─ Tags                  │
        │ └─ article_tag           │
        └────────┬──────────────────┘
                 │
                 ↓ (النتائج)
        ┌─────────────────────┐
        │   Model            │
        │ معالجة النتائج     │
        └─────────┬──────────┘
                  │
                  ↓
        ┌──────────────────────┐
        │  Service            │
        │ تنسيق البيانات     │
        └─────────┬───────────┘
                  │
                  ↓
        ┌──────────────────────┐
        │  View                │
        │ عرض في HTML         │
        └─────────┬───────────┘
                  │
                  ↓
        ┌──────────────────────┐
        │  Response            │
        │ إرسال إلى المتصفح   │
        └─────────┬───────────┘
                  │
                  ↓
        ┌──────────────────────┐
        │  المتصفح يعرض الصفحة│
        └──────────────────────┘
```

---

## 📝 ملخص الملفات الهامة

| الملف | الدور |
|------|-------|
| `User.php` | نموذج المستخدم |
| `Article.php` | نموذج المقالة |
| `Category.php` | نموذج الفئة |
| `Tag.php` | نموذج الوسم |
| `ArticleService.php` | معالجة منطق المقالات |
| `ArticleFactory.php` | توليد بيانات وهمية للمقالات |
| `UserFactory.php` | توليد بيانات وهمية للمستخدمين |
| `DatabaseSeeder.php` | ملء قاعدة البيانات الأولية |
| `web.php` | المسارات والروابط |

---

## 🎓 النقاط الأساسية

✅ **Models**: تمثيل البيانات وعلاقاتها  
✅ **Factories**: توليد بيانات وهمية  
✅ **Services**: معالجة منطق العمل  
✅ **Migrations**: إنشاء وتعديل الجداول  
✅ **Seeders**: ملء البيانات الأولية  
✅ **Controllers**: معالجة الطلبات  
✅ **Views**: عرض البيانات  

جميع هذه الأجزاء تعمل معاً لإنشاء تطبيق مدونة كامل وفعال! 🚀

