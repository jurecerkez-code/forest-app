🌲 Forest App
A guided meditation tracker built with Laravel and Livewire. Forest App lets users log meditation trips, listen to curated audio sessions, rate their experience, and share comments – all with secure email authentication.

Features
Email authentication (no phone required)
Start meditation trips with a selection of audio guides
Track trip details: duration, satisfaction rating, and completion status
Comment system for sharing feedback and experiences
Voice session tracking for each trip
Dashboard with user stats (trips, satisfaction, favorite audio, etc.)
Getting Started
Prerequisites
PHP >= 8.2
Composer
Node.js & npm
SQLite (default, easy setup)
Installation
Clone the repository
bash

Copy
git clone https://github.com/yourusername/forest-app.git
cd forest-app
Install dependencies
bash

Copy
composer install
npm install
Setup environment
bash

Copy
cp .env.example .env
php artisan key:generate
Configure database
The app uses SQLite by default. Create the database file:
bash

Copy
touch database/database.sqlite
- In `.env`, set:
      DB_CONNECTION=sqlite
Run migrations and seed sample data
bash

Copy
php artisan migrate
php artisan db:seed
Start the development server
bash

Copy
php artisan serve
# or
herd open
Access the app
Visit 
http://localhost:8000
Register a new account, or use test credentials:
      Email: test@example.com
      Password: password
Usage
Start a new meditation trip: Select an audio session and begin tracking.
Complete trips: Rate your satisfaction when finished.
View trip history: See details, listen again, and review your stats.
Add comments: Share your experiences with each trip.
Project Structure
app/Models – Eloquent models (User, Trip, VoiceSession, Comment)
app/Http/Controllers – Controllers for trips, comments, dashboard
resources/views – Blade templates for UI
routes/web.php – Web routes (protected by authentication)
database/migrations – Table definitions
database/seeders – Sample data for testing
Customization & Next Steps
Add your own audio files to public/audio
Enhance UI with Tailwind CSS
Implement statistics dashboard and email notifications
(Coming soon) Admin features for managing users
Troubleshooting
Clear caches:
php artisan config:clear && php artisan cache:clear && php artisan view:clear
Reset database:
php artisan migrate:fresh && php artisan db:seed
Check logs:
storage/logs/laravel.log
License
MIT

Happy meditating! 🌳
