import React, { useState } from "react";
import {
  MDBContainer,
  MDBRow,
  MDBCol
} from "mdb-react-ui-kit";

const images = [
  "/images/guit.webp",
  "/images/greenguit.jpg",
  "/images/guitar2.jpg",
  "/images/greenguit.jpg",
  "/images/guit.webp"
];

function NotreMagasin() {
  const [mainImage, setMainImage] = useState(images[0]);

  return (
    <MDBContainer className="py-4">
      <MDBRow className="shadow-5">
        <MDBCol size="12" className="mb-3">
          <div
            onClick={() => window.open(mainImage, "_blank")}
            style={{ cursor: "zoom-in" }}
          >
            <img
              src={mainImage}
              alt="Main"
              className="w-100 rounded"
              style={{
                maxHeight: "500px",
                objectFit: "contain",
                transition: "0.3s",
              }}/>
          </div>
        </MDBCol>

        {images.map((img, index) => (
          <MDBCol size="3" key={index} className="mb-2">
           <img
            src={img}
            alt={`Thumb ${index}`}
            onClick={() => setMainImage(img)}
            className={`thumb-img ${mainImage === img ? "border border-primary" : ""}`}
            style={{ cursor: "pointer", transition: "0.3s" }}
            />

          </MDBCol>
        ))}
      </MDBRow>
    </MDBContainer>
  );
}

export default NotreMagasin;
