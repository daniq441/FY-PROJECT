@extends('layouts.post')
@section('content')
  <section class="home-page pt-4">
    <div class="container">
    <form action="{{ route('paperpksearch') }}" method="GET">
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
                          <a href="{{ route('resetpaperpk') }}" class="btn btn-danger">Reset</a>
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
                  <th colspan="6" class="text-center">PaperPk Jobs</th>
                </tr>
                <tr>
                  <th>Title</th>
                  <th>Salary</th>
                  <th>Vacancies</th>
                  <th>Location</th>
                  <th>Apply Before</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jobs as $job)
                  <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->salary }}</td>
                    <td>{{ $job->vacancies }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->apply_bef }}</td>
                    <td>
                      <div class="btn-group" role="group">
                        <a class="btn btn-warning" href="{{ $job->url }}" target="_blank">Click here to apply</a>
                        <a class="btn btn-info" href="{{ $job->image }}" target="_blank">View Image</a>
                      </div>
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
