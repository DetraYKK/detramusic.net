<?php
$posts = [
    [
        'title' => 'Dreams',
        'date' => '2023-05-18',
        'description' => 'My song release Dreams about how I wish I could look into my future and see whether I am going to make it or not.',
        'lyrics_file' => 'dreams.txt',
        'youtube_link' => 'https://www.youtube.com/watch?v=1Xar0OYM0ps&t=5s'
    ],
    [
        'title' => 'Wake Up',
        'date' => '2023-06-07',
        'description' => 'My release of the song called Wake Up.',
        'lyrics_file' => 'wake_up.txt',
        'youtube_link' => 'https://www.youtube.com/watch?v=GdQij7Ujdfk&t=1s'
    ],
    [
        'title' => 'The Way You Love Me',
        'date' => '2023-02-14',
        'description' => 'My song release called The Way You Love Me which describes how I love the way my wife loves me and makes love to me.',
        'lyrics_file' => 'the_way_you_love_me.txt',
        'youtube_link' => 'https://www.youtube.com/watch?v=qFFMeErXhnw'
    ],
    [
        'title' => 'What\'s the Difference',
        'date' => '2023-03-25',
        'description' => 'Explaining the differences in music genres.',
        'lyrics_file' => 'whats_the_difference.txt',
        'youtube_link' => '#'
    ]
];

usort($posts, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
?>

<?php foreach ($posts as $post): ?>
    <div class="post">
        <h2><?php echo $post['title']; ?></h2>
        <p class="post-date"><?php echo $post['date']; ?></p>
        <p><?php echo $post['description']; ?></p>
        <div class="post-actions">
            <a href="<?php echo $post['youtube_link']; ?>" target="_blank">Watch on YouTube</a>
            <button onclick="toggleLyrics('<?php echo $post['lyrics_file']; ?>', this)">Show Lyrics</button>
            <div class="lyrics-content" id="<?php echo $post['lyrics_file']; ?>"></div>
        </div>
        <hr class="separator">
    </div>
<?php endforeach; ?>

<script>
function toggleLyrics(file, button) {
    var lyricsDiv = document.getElementById(file);
    if (lyricsDiv.style.display === "none" || lyricsDiv.style.display === "") {
        fetch('lyrics/' + file)
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    return "No lyrics has been added yet.";
                }
            })
            .then(text => {
                lyricsDiv.innerHTML = '<pre>' + text + '</pre>';
                lyricsDiv.style.display = "block";
                button.textContent = "Hide Lyrics";
            })
            .catch(error => {
                lyricsDiv.innerHTML = "No lyrics has been added yet.";
                lyricsDiv.style.display = "block";
                button.textContent = "Hide Lyrics";
            });
    } else {
        lyricsDiv.style.display = "none";
        button.textContent = "Show Lyrics";
    }
}
</script>
