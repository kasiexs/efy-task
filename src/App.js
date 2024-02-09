import React, { useState, useEffect } from '@wordpress/element';

function App() {
    const [posts, setPosts] = useState([]);
  
    useEffect(() => {
      const fetchPosts = async () => {
        try {
          const response = await fetch('/wp-json/efy/v1/trening');
          if (!response.ok) {
            throw new Error('Failed to fetch data');
          }
          const data = await response.json();
          setPosts(data);
        } catch (error) {
          console.error(error);
        }
      };
  
      fetchPosts();
    }, []);
  
    return (
      <div className="training_list">
        {posts.map((post) => (
          <div className="training_box" key={post.id}>
            <div className="training_thumb"><a href={`/trening/${post.slug}`}>{post.thumbnail && <img src={post.thumbnail.medium}  />}</a></div>
            <h2 className="training_title"><a href={`/trening/${post.slug}`}>{post.title}</a></h2>
            {post.termin && <div className="training_date">{post.termin}  {post.czas_trwania && <span>Czas trwania: {post.czas_trwania}</span>}</div>}
            {post.krotki_opis && <div className="training_desc">{post.krotki_opis}</div>}
            {post.cena && <div className="training_price">{post.cena}</div>}
            {post.prowadzacy && <div className="training_person">Prowadzący: <span>{post.prowadzacy}</span></div>}
            
          </div>
        ))}
      </div>
    );
  }
  
  export default App;
  