/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    //Creo el carrousel
    const mySiema = new Siema({
        loop: true,
    });

    //Le añado una funcion para paginar
    Siema.prototype.addPagination = function () {
        for (let i = 0; i < this.innerElements.length; i++) {
            const btn = document.createElement('button');
            btn.className = 'ui basic circular button';
            btn.textContent = i;
            btn.addEventListener('click', () => this.goTo(i));
            this.selector.appendChild(btn);
        }
    }

    mySiema.addPagination();

    const prev = document.getElementById('prev');
    const next = document.getElementById('next');

    prev.addEventListener('click', () => mySiema.prev());
    next.addEventListener('click', () => mySiema.next());
});


