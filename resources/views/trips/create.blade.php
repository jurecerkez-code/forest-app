<x-layouts.app>
  <div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Start New Meditation Trip</h1>

    <form action="{{ route('trips.store') }}" method="POST">
      @csrf

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Select Meditation Session</label>
        <select id="audioSelect" name="audio_file" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
          <option value="" disabled selected>Choose a session...</option>
          <option value="meditation_forest.mp3">Forest Sounds - 10 min</option>
          <option value="meditation_nature.mp3">Nature Sounds - 10 min</option>
          <option value="meditation_breathing.mp3">Breathing Exercise - 10 min</option>
          <option value="meditation_mindfulness.mp3">Mindfulness Walk - 10 min</option>
        </select>
        @error('audio_file')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
        <audio id="audioPreview" controls class="w-full" preload="none" style="display: none;">
          <source id="audioSource" src="" type="audio/mpeg">
          Your browser does not support the audio element.
        </audio>
      </div>

      <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg">Start Trip</button>
      <a href="{{ route('trips.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg ml-4">Cancel</a>
    </form>
  </div>

  <script>
    const audioSelect = document.getElementById('audioSelect');
    const audioPreview = document.getElementById('audioPreview');
    const audioSource = document.getElementById('audioSource');

    audioSelect.addEventListener('change', function() {
      const selectedFile = this.value;
      if (selectedFile) {
        audioSource.src = `/audio/${selectedFile}`;
        audioPreview.load();
        audioPreview.style.display = 'block';
      } else {
        audioPreview.pause();
        audioPreview.style.display = 'none';
      }
    });
  </script>
</x-layouts.app>
