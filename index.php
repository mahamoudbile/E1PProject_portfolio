<!-- header laden en data -->
<?php
require_once 'includes/header.php';
$query = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($query);
$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}
?>
<!-- banner -->
<section class="banner">
    <div class="banner-content">
        <h2>Mahamoud <br><span>B.Ciise</span></h2>
        <p>Software developer student</p>
    </div>   

    <div class="img_banner">
    <span class="star-icon top-left"><i class="fas fa-star"></i></span>
    <span class="star-icon top-right"><i class="fas fa-star"></i></span>
    <span class="star-icon bottom-left"><i class="fas fa-star"></i></span>
    <span class="star-icon bottom-right"><i class="fas fa-star"></i></span>
    <img src="/E1PProject/img/banner_img.jpg" alt="web_dev">
    <div class="overlay"></div>
</div>


     <div class="general_info">
        <p class="subtitle">HTML/CSS</p>
        <p class="subtitle">JS/AJAX</p>
        <p class="tagline">PHP</p>
        <p class="tagline">Laravel</p>
        <p class="tagline">Codenight</p>
        <div class="contact-info">
            <span>0651759984</span> | <span>mahamoudbileciise@hotmail.com</span>
        </div>
     </div>
</section>

<!-- projects tonen -->
<section class="project-grid">
<div class="container mt-5">
    <div class="row">
        <?php foreach ($projects as $project): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
            <?php
                $imgPath = "uploads/" . basename($project['image_path']);  // Verwijder '../' uit het pad

                if (file_exists($imgPath)) {
                    echo '<img src="' . htmlspecialchars($imgPath) . '" class="card-img-top" alt="' . htmlspecialchars($project['title']) . '">';
                } else {
                    echo '<p>Afbeelding bestaat niet op het opgegeven pad: ' . htmlspecialchars($imgPath) . '</p>';
                }
                ?>
                <div class="card-body">
                    <h5 class="card-title"><b>Title:</b> <?php echo htmlspecialchars($project['title']); ?></h5>
                    <p class="card-text"><b>Description</b>: <?php echo htmlspecialchars($project['description']); ?></p>
                    <p class="card-text"><b>Datum:</b>: <?php echo htmlspecialchars($project['created_at']); ?></p>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a href="admin/edit_project.php?id=<?php echo $project['id']; ?>" class="btn btn-primary">Bewerk Project</a>
                        <a href="#" class="btn btn-danger" onclick="openDeleteModal('<?php echo $project['id']; ?>', '<?php echo addslashes($project['title']); ?>')">Verwijder Project</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (count($projects) === 0): ?>
            <p>Geen projecten gevonden.</p>
        <?php endif; ?>
    </div>
</div>
</section>



<!-- Verwijder Project Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProjectModalLabel">Verwijder Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Om het project <strong id="projectTitle"></strong> te verwijderen, voer de projectnaam in ter bevestiging.</p>
        <form id="deleteProjectForm">
          <div class="form-group">
            <label for="confirmProjectName">Bevestig de projectnaam:</label>
            <input type="text" class="form-control" id="confirmProjectName" name="confirmProjectName" required>
          </div>
          <input type="hidden" id="projectId" name="projectId">
          <div class="alert alert-danger d-none" id="errorMessage">De ingevoerde projectnaam komt niet overeen!</div>
          <button type="submit" class="btn btn-danger">Verwijder Project</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
function openDeleteModal(projectId, projectTitle) {
    // Vul de projectgegevens in de modal
    document.getElementById('projectTitle').innerText = projectTitle;
    document.getElementById('projectId').value = projectId;

    // Maak het error bericht onzichtbaar
    document.getElementById('errorMessage').classList.add('d-none');

    // Open de modal
    $('#deleteProjectModal').modal('show');
}

// Voeg een event listener toe aan het formulier
document.getElementById('deleteProjectForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const projectId = document.getElementById('projectId').value;
    const confirmProjectName = document.getElementById('confirmProjectName').value;
    const projectTitle = document.getElementById('projectTitle').innerText;

    if (confirmProjectName === projectTitle) {

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'admin/delete_project.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $('#deleteProjectModal').modal('hide');
    
                location.reload();
            }
        };
        xhr.send('id=' + projectId);
    } else {

        document.getElementById('errorMessage').classList.remove('d-none');
    }
});
</script>


<!-- footer -->
<?php require_once 'includes/footer.php' ?>

</body>
</html>