<style>
.drop-zone {
  max-width: 700px;
  height: 200px;
  padding: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #cccccc;
  border: 4px dashed #009578;
  border-radius: 10px;
}
.drop-zone--over {
  border-style: solid;
}
.drop-zone__input {
  display: none;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}
.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}
</style>
<div class="w3-container">
    <header class="w3-container">
        <h3>Upload Your Profile Picture</h3>
    </header>
    <div class="w3-container">
        <div class="d-flex justify-content-center p-3 flex-row">
            <div class="p-3" style="width: 400pt;">
            <div class="drop-zone">
                <span class="drop-zone__prompt"> drop file here</span>
                <input type="file" name="myfile" class="drop-zone__input">
                
            </div>
            </div>
        </div>
        <div class="w3-container">
            <input type="submit" class="w3-button w3-blue" name="submit" value="upload">
        </div>
    </div>
</div>

<script>
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");
dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });
inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });
dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });
["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();
if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }
dropZoneElement.classList.remove("drop-zone--over");
  });
});
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
// First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }
// First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

thumbnailElement.dataset.label = file.name;
// Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();
reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
} 
</script>