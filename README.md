# 🌲 Forest App

Forest App is a friendly Laravel + Livewire app for guided meditation. It helps you:
- 🎧 pick an audio guide and start a “trip”
- ⭐ rate your satisfaction when you finish
- 💬 share comments and reflections
- 📊 see personal stats (trips, satisfaction, favorite audio)
- 🔐 log in securely with email (no phone needed)

Built by **Jure Čerkez** — repo: https://github.com/jurecerkez-code/forest-app

## ✨ What it does (in plain words)

- You start a meditation session with a chosen audio track, and the app tracks the trip.
- When you’re done, you mark it complete, add a satisfaction rating, and optionally leave a comment.
- Over time, the dashboard shows your progress: how often you meditate, which audio you prefer, and overall satisfaction trends.
- Everything is tied to your account with simple email-based auth.

## 🚀 Installation (no code blocks, just commands)

- Clone the repo: `git clone https://github.com/jurecerkez-code/forest-app.git` then `cd forest-app`
- Install dependencies: `composer install` and (optional) `npm install`
- Create environment: `cp .env.example .env` then `php artisan key:generate`
- Use SQLite (default):
  - Create DB file: `mkdir -p database` then `touch database/database.sqlite`
  - In `.env`, set: `DB_CONNECTION=sqlite`
- Migrate and seed sample data: `php artisan migrate:fresh --seed`
- Start the server: `php artisan serve`
- Open the app: `http://localhost:8000`

Seeded admin for testing: `admin@admin.com` / `password`

## 🧭 Usage

- Start a trip: choose an audio guide and hit start.
- Finish a trip: rate satisfaction and mark it complete.
- Read and write comments: reflect on your experience.
- Review stats: track your progress and favorite audio guides.

## 🗂️ Structure

- Models: `User`, `Trip`, `VoiceSession`, `Comment`
- Controllers: trips, comments, dashboard, users
- Views: Blade + Livewire components
- Routes: `routes/web.php` (protected by auth)
- Database: migrations and seeders for quick setup
- Audio: add files to `public/audio`

## 🎨 Customization

- Drop your own audio files into `public/audio`
- Tweak styles with Tailwind CSS
- Extend the dashboard or add admin features as you like

## 🛠️ Troubleshooting

- Clear caches: `php artisan config:clear && php artisan cache:clear && php artisan view:clear`
- Reset DB: `php artisan migrate:fresh --seed`
- Check logs: `storage/logs/laravel.log`

## 🤝 Contributing

Pull requests are welcome. For major changes, open an issue first to discuss what you’d like to change.  
Please update tests as appropriate.

## 📄 License

MIT — use freely and kindly.
