const catBtns = document.querySelectorAll('.btn-cat');
const items = document.querySelectorAll('.items-container .item-container');

for (const btn of catBtns) {
    btn.addEventListener('click', () => {
        for (const item of items) {
            if(item.classList.contains(btn.classList[1]))
            {
                btn.classList.add('selected')
                for (const obtn of catBtns) {
                    if(obtn != btn && obtn.classList.contains('selected'))
                        obtn.classList.remove('selected');

                }
                item.classList.toggle('visible');
                for (const oitem of items) {
                    if(oitem.classList[1] != item.classList[1] && oitem.classList.contains('visible'))
                        oitem.classList.remove('visible');
                }
            }
        }
       
    })
}

catBtns[0].click();