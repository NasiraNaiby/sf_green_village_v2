function NotreMagasin(){
    return(
        <>
        <section className="hero-section">
  <div className="container">
    <h1>Notre Magazine</h1>
    <div className="featured-article">
      <img src="/images/featured-article.jpg" alt="Featured article" />
      <div className="text-overlay">
        <h2>Discover the Future of Music Production</h2>
        <p>Explore the latest trends, gear reviews, and interviews with industry leaders.</p>
        <a href="" className="btn-primary">Read More</a>
      </div>
    </div>
  </div>
</section>

<section className="articles-section container">
  <aside className="categories-sidebar">
    <h3>Categories</h3>
    <ul>
      <li><a href="">Gear Reviews</a></li>
      <li><a href="">Artist Interviews</a></li>
      <li><a href="">Tutorials</a></li>
      <li><a href="">Industry News</a></li>
    </ul>
  </aside>

  <main className="articles-grid">
    {/* Map your articles here */}
    <article className="article-card">
      <img src="/images/article1.jpg" alt="Article 1" />
      <h4>Top 10 Synthesizers of 2025</h4>
      <p>A deep dive into the most powerful synths changing the music scene this year.</p>
      <a href="" className="read-more">Read More</a>
    </article>
    {/* More articles */}
  </main>
</section>

        </>
    )
}

export default NotreMagasin