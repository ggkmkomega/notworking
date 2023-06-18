const imgContainer = document.getElementById('img-container');
const inputFiles = document.getElementById('img-input');
let oldList = imgContainer.querySelectorAll('.img-item');






function test(){
    oldList = imgContainer.querySelectorAll('.img-item');
    for(const item of oldList){
        item.remove();
    }

    for (let file of inputFiles.files) {

        img = document.createElement("img");
        img.src = URL.createObjectURL(file);

        imgItem = document.createElement("div");
        imgItem.classList.add('img-item')
        imgItem.id = file.name;
        
        deletebtn = document.createElement("div");
        icon = document.createElement("i");
        icon.classList.add('fa-regular');
        icon.classList.add('fa-circle-xmark');
        deletebtn.classList.add('delete-hover');

        deletebtn.appendChild(icon);
        imgItem.appendChild(img);
        imgItem.appendChild(deletebtn);

        imgContainer.appendChild(imgItem);

        deletebtn.addEventListener('click', function () {

            const dt = new DataTransfer();
            const { files } = inputFiles;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.name !== this.parentNode.id){
                    dt.items.add(file) // here you exclude the file. thus removing it.
                }
            }
            
            inputFiles.files = dt.files // Assign the updates list

            console.log(this.parentNode.id);
            this.parentNode.remove();
        });

    }
}