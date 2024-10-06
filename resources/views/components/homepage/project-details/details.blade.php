   <!-- Project Details Section -->
   <section id="service-details" class="service-details section">

       <div class="container">

           <div class="row gy-4">
               <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                   <img src="{{ $project->image }}" alt="" class="img-fluid services-img">
                   <h3>{{ $project->name }}</h3>
                   <p>{{ $project->description }}</p>
                   {{-- <ul>
                    <li><i class="bi bi-check-circle"></i> <span>Aut eum totam accusantium voluptatem.</span></li>
                    <li><i class="bi bi-check-circle"></i> <span>Assumenda et porro nisi nihil nesciunt
                            voluptatibus.</span></li>
                    <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea</span></li>
                </ul>
                <p>
                    Est reprehenderit voluptatem necessitatibus asperiores neque sed ea illo. Deleniti quam sequi optio
                    iste veniam repellat odit. Aut pariatur itaque nesciunt fuga.
                </p>
                <p>
                    Sunt rem odit accusantium omnis perspiciatis officia. Laboriosam aut consequuntur recusandae
                    mollitia doloremque est architecto cupiditate ullam. Quia est ut occaecati fuga. Distinctio ex
                    repellendus eveniet velit sint quia sapiente cumque. Et ipsa perferendis ut nihil. Laboriosam vel
                    voluptates tenetur nostrum. Eaque iusto cupiditate et totam et quia dolorum in. Sunt molestiae ipsum
                    at consequatur vero. Architecto ut pariatur autem ad non cumque nesciunt qui maxime. Sunt eum quia
                    impedit dolore alias explicabo ea.
                </p> --}}
               </div>

               <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Project Name</td>
                            <td> {{ $project->name }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ $project->category }}</td>
                        </tr>
                        <tr>
                            <td>Published Date</td>
                            <td>{{ date('F j, Y', strtotime($project->published_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Project URL</td>
                            <td><a target="_blank" href="{{ $project->url }}">{{ $project->url }}</a></td>
                        </tr>
                    </tbody>
                </table>



                   <div class="services-list">
                       @foreach ($projects as $project)
                           <a href="{{ route('home.project-details', $project->id) }}"
                               class="active">{{ $project->name }}
                               <i style="display: inline-block; float: right" class="bi bi-link"></i>
                           </a>
                       @endforeach
                   </div>


               </div>


           </div>

       </div>

   </section><!-- /Project Details Section -->
