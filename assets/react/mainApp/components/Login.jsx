function Login() {
    return (
      <div className="container">
        <div className="user_login col-md-4 col-lg-6 mx-auto">
          <form>
            <div className="mb-3">
              <label htmlFor="exampleInputEmail1" className="form-label">
                Email
              </label>
              <input type="email" className="form-control" id="exampleInputEmail1" placeholder="Email" aria-describedby="emailHelp"/>
            </div>
            <div className="mb-3">
              <div className="d-flex justify-content-between">
                <label htmlFor="exampleInputPassword1" className="form-label">
                  Mot de pass
                </label>
                <small className="text-muted">Au minimum 6 character</small>
              </div>
  
              <div className="input-group has-validation">
                <input type="password" className="form-control " id="exampleInputPassword1" placeholder="mot de pass"
                />
                <span className="input-group-text">
                  <i className="fas fa-eye"></i>
                </span>
                <div className="invalid-feedback d-block">
                  <i className="fas fa-exclamation-triangle me-1 text-danger"></i>
                  Error Message.
                </div>
              </div>
            </div>
            <div className="mb-3 form-check">
              <input type="checkbox" className="form-check-input" id="exampleCheck1" />
              <label className="form-check-label" htmlFor="exampleCheck1">
                Souviens-toi de moi
              </label>
            </div>
            <button type="submit" className="btn btn-primary">
              Se connecter
            </button>
          </form>
        </div>
      </div>
    );
  }
  
  export default Login;
  