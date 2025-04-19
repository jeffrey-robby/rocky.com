function getToastrOptions(params) {
    if (params == 0) {
        document.getElementById("getToastrOptions").innerHTML = '<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert"><i class="ph ph-lifebuoy"></i><span> Utilisateur Introuvable —check it out!</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    if (params == 1) {
        document.getElementById("getToastrOptions").innerHTML = '<div class="alert alert-success alert-dismissible fade show mb-3" role="alert"><i class="ph ph-thumbs-up"></i><span> Effectuer avec succès!</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    if (params == 2) {
        document.getElementById("getToastrOptions").innerHTML = '<div class="alert alert-warning alert-dismissible fade show mb-3" role="alert"><i class="ph ph-bell-ringing"></i><span> Un problème est Survenu - contacter un administrateur!</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    // if (params == 3) {
    //     document.getElementById("getToastrOptions").innerHTML = '<div class="alert alert-info alert-dismissible fade show mb-3" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill01" /></svg><span> This is a success alert—check it out!</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    // }
}


