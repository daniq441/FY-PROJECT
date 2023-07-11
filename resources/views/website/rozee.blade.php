@extends('layouts.post')
@section('content')
  <section class="home-page pt-4">
    <div class="container">
      <form action="{{ route('rozeesearch') }}" method="GET">
          <div class="row">
              <div class="col-sm-12 col-md-6">
                  <div class="px-4">
                      <div class="rounded-text">
                          <p>
                              Find jobs, vacancies, career online.
                          </p>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6">
                  <div class="py-5 px-5 text-center">
                      <div class="text-light">
                          <h4>The path to realizing your dreams is paved with perseverance, resilience, and a strong work ethic.</h4>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-12">
                  <div class="input-group mb-3">
                      <input type="text" name="title" class="form-control" placeholder="Search by title">
                      <input type="text" name="location" class="form-control" placeholder="Search by location">
                      <div class="input-group-append">
                          <button class="btn btn-primary" type="submit">Search</button>
                          <a href="{{ route('resetrozee') }}" class="btn btn-danger">Reset</a>
                      </div>
                  </div>
              </div>
          </div>
      </form>
    </div>
  </section>
  <section class="jobs-section py-5">
    <div class="container-fluid px-0">
      <form action="{{ route('job.index') }}">
        <!-- Your search form code here -->
      </form>
      <div class="row">
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th colspan="8" class="text-center">Rozee Jobs</th>
                </tr>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Vacancies</th>
                  <th>Location</th>
                  <th>Min Education</th>
                  <th>Min Experience</th>
                  <th>Apply Before</th>
                  <th>URL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jobs as $job)
                <tr>
                  <td>{{ $job->title }}</td>
                  <td>
                    @php
                      $description = $job->description;
                      $words = explode(' ', $description);
                      $limitedDescription = implode(' ', array_slice($words, 0, 15));
                    @endphp
                    {{ $limitedDescription }}
                    @if(count($words) > 15)
                      <a href="#" class="read-more-link text-danger" data-toggle="modal" data-target="#readMoreModal{{ $job->id }}">Read More</a>
                      <!-- Read More Modal -->
                      <div class="modal fade" id="readMoreModal{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="readMoreModalLabel{{ $job->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="readMoreModalLabel{{ $job->id }}">Job Description</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              {{ $job->description }}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </td>
                  <td>{{ $job->vacancies }}</td>
                  <td>{{ $job->location }}</td>
                  <td>{{ $job->min_education }}</td>
                  <td>{{ $job->min_experience }}</td>
                  <td>{{ $job->apply_bef }}</td>
                  <td>
                  <a class="btn btn-warning" href="{{ $job->url }}" target="_blank">Click here to apply</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{ $jobs->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection