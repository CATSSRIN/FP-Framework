<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Librarian User
        User::create([
            'name' => 'Pustakawan',
            'email' => 'librarian@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'librarian',
        ]);

        // Create Member User
        User::create([
            'name' => 'Anggota',
            'email' => 'member@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Buku-buku fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku-buku non-fiksi dan referensi'],
            ['name' => 'Sains', 'description' => 'Buku-buku ilmu pengetahuan'],
            ['name' => 'Teknologi', 'description' => 'Buku-buku teknologi dan komputer'],
            ['name' => 'Sejarah', 'description' => 'Buku-buku sejarah dan biografi'],
            ['name' => 'Agama', 'description' => 'Buku-buku keagamaan'],
            ['name' => 'Pendidikan', 'description' => 'Buku-buku pendidikan dan pembelajaran'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Books
        $books = [
            ['category_id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'publication_year' => 2005, 'isbn' => '978-979-1227-32-2', 'stock' => 5, 'available_stock' => 5, 'description' => 'Novel tentang perjuangan anak-anak Belitung untuk mendapatkan pendidikan.'],
            ['category_id' => 1, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'publication_year' => 1980, 'isbn' => '978-979-433-001-3', 'stock' => 3, 'available_stock' => 3, 'description' => 'Novel sejarah tentang perjuangan Minke melawan kolonialisme.'],
            ['category_id' => 2, 'title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'publisher' => 'Kompas', 'publication_year' => 2018, 'isbn' => '978-602-412-439-9', 'stock' => 4, 'available_stock' => 4, 'description' => 'Buku tentang filosofi Stoa untuk kehidupan modern.'],
            ['category_id' => 3, 'title' => 'Sapiens: A Brief History of Humankind', 'author' => 'Yuval Noah Harari', 'publisher' => 'Harvill Secker', 'publication_year' => 2011, 'isbn' => '978-0-06-231609-7', 'stock' => 2, 'available_stock' => 2, 'description' => 'Buku tentang sejarah umat manusia.'],
            ['category_id' => 4, 'title' => 'Clean Code', 'author' => 'Robert C. Martin', 'publisher' => 'Prentice Hall', 'publication_year' => 2008, 'isbn' => '978-0-13-235088-4', 'stock' => 3, 'available_stock' => 3, 'description' => 'Panduan untuk menulis kode yang bersih dan mudah dipelihara.'],
            ['category_id' => 4, 'title' => 'The Pragmatic Programmer', 'author' => 'David Thomas', 'publisher' => 'Addison-Wesley', 'publication_year' => 2019, 'isbn' => '978-0-13-595705-9', 'stock' => 2, 'available_stock' => 2, 'description' => 'Panduan untuk menjadi programmer yang pragmatis.'],
            ['category_id' => 5, 'title' => 'Sejarah Indonesia Modern', 'author' => 'M.C. Ricklefs', 'publisher' => 'Serambi', 'publication_year' => 2005, 'isbn' => '978-979-709-145-3', 'stock' => 4, 'available_stock' => 4, 'description' => 'Buku tentang sejarah Indonesia dari awal hingga modern.'],
            ['category_id' => 7, 'title' => 'Psikologi Pendidikan', 'author' => 'John Santrock', 'publisher' => 'McGraw-Hill', 'publication_year' => 2017, 'isbn' => '978-1-259-25207-1', 'stock' => 3, 'available_stock' => 3, 'description' => 'Buku tentang psikologi dalam konteks pendidikan.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Create Members
        $members = [
            ['member_id' => 'MBR00001', 'name' => 'Ahmad Fauzi', 'email' => 'ahmad@example.com', 'phone' => '081234567890', 'address' => 'Jl. Sudirman No. 1, Jakarta', 'status' => 'active', 'join_date' => '2024-01-15'],
            ['member_id' => 'MBR00002', 'name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'phone' => '081234567891', 'address' => 'Jl. Gatot Subroto No. 5, Bandung', 'status' => 'active', 'join_date' => '2024-02-20'],
            ['member_id' => 'MBR00003', 'name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567892', 'address' => 'Jl. Diponegoro No. 10, Surabaya', 'status' => 'active', 'join_date' => '2024-03-10'],
            ['member_id' => 'MBR00004', 'name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'phone' => '081234567893', 'address' => 'Jl. Ahmad Yani No. 15, Yogyakarta', 'status' => 'active', 'join_date' => '2024-04-05'],
            ['member_id' => 'MBR00005', 'name' => 'Rizky Pratama', 'email' => 'rizky@example.com', 'phone' => '081234567894', 'address' => 'Jl. Pahlawan No. 20, Semarang', 'status' => 'inactive', 'join_date' => '2024-05-01'],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }

        // Create some loans
        $loans = [
            ['book_id' => 1, 'member_id' => 1, 'loan_date' => '2024-11-01', 'due_date' => '2024-11-15', 'return_date' => '2024-11-14', 'status' => 'returned', 'fine_amount' => 0],
            ['book_id' => 2, 'member_id' => 2, 'loan_date' => '2024-11-10', 'due_date' => '2024-11-24', 'return_date' => null, 'status' => 'borrowed', 'fine_amount' => 0],
            ['book_id' => 3, 'member_id' => 3, 'loan_date' => '2024-11-15', 'due_date' => '2024-11-29', 'return_date' => null, 'status' => 'borrowed', 'fine_amount' => 0],
            ['book_id' => 4, 'member_id' => 1, 'loan_date' => '2024-10-01', 'due_date' => '2024-10-15', 'return_date' => null, 'status' => 'overdue', 'fine_amount' => 0],
        ];

        foreach ($loans as $loan) {
            Loan::create($loan);
            // Update book available stock
            Book::find($loan['book_id'])->decrement('available_stock');
        }
    }
}
