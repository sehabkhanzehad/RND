<div class="row">

    <div class="col-md-4">

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Favicon</h6>
                    <div class="form-group">
                        <label>Favicon</label>
                        <input id="favicon" type="file" name=""
                            onchange="document.getElementById('fav').src = window.URL.createObjectURL(this.files[0])"
                            class="form-control">
                        <div class="my-3">
                            <img src="" id="fav" width="20" alt="">
                        </div>
                    </div>
                    <button onclick="upadteFavicon()" type="submit"
                        class="btn btn-primary mr-2 float-right">Update</button>
                </div>
            </div>
        </div>

        {{-- <br> --}}

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Header Logo</h6>
                    <div class="form-group">
                        <label>Header Logo</label>
                        <input id="header_logo" type="file" name="image"
                            onchange="document.getElementById('header0').src = window.URL.createObjectURL(this.files[0])"
                            class="form-control">
                        <div class="my-3">
                            <img src="" id="header0" width="35" alt="">
                        </div>
                    </div>
                    <button onclick="updateHeaderLogo()" type="submit"
                        class="btn btn-primary mr-2 float-right">Update</button>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Footer</h6>
                <div class="form-group">
                    <label>Header Logo</label>
                    <input id="footer_logo" type="file" name="image"
                        onchange="document.getElementById('footer0').src = window.URL.createObjectURL(this.files[0])"
                        class="form-control">
                    <div class="my-3">
                        <img src="" id="footer0" width="50" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label>Footer Text</label>
                    <textarea id ="footer_text" placeholder="Footer Text" class="form-control" style="font-size: px; text-align: justify;"
                        name="" rows="11"></textarea>
                </div>
                <button onclick="upadteFooter()" type="submit" class="btn btn-primary mr-2 float-right">Update</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Social</h6>
                <div class="form-group">
                    <label>Facebook Link</label>
                    <input id="facebook_link" placeholder="Facebook Link" value="" type="text" name="" class="form-control">
                </div>

                <div class="form-group">
                    <label>Whatsapp Link</label>
                    <input id="whatsapp_link" value="" placeholder="Whatsapp Link" type="text" name="" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label>Linkedin Link</label>
                    <input id="linkedin_link" value="" placeholder="Linkedin Link" type="text" name="" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label>Twitter Link</label>
                    <input id="twitter_link" value="" placeholder="Twitter Link" type="text" name="" class="form-control">
                </div>
                {{-- <div class="form-group">
                    <label>Insagram Link</label>
                    <input id="instagram_link" value="" type="text" name="" class="form-control">
                </div> --}}

                <button onclick="updateSocial()" type="submit" class="btn btn-primary mr-2 float-right">Update</button>
            </div>
        </div>
    </div>

</div>
