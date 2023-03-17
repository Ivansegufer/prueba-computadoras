const tabla = document.querySelector("#computadoras tbody");
const submitBtn = document.getElementById("btn-submit");

const eliminarComputadora = async (id) => {
  const confirmacion = confirm(
    "¿Está seguro que desea eliminar esta computadora?"
  );
  if (confirmacion) {
    const response = await fetch(`/controller.php?id=${id}`, {
      method: "DELETE",
    });
    if (response.ok) {
      location.reload(); // recargar la página para reflejar el cambio
    } else {
      alert("Ocurrió un error al eliminar la computadora.");
    }
  }
};

const fetchData = async () => {
  const response = await fetch("/controller.php");
  const data = await response.json();

  data.forEach((computadora) => {
    const fila = `
        <tr>
            <td>${computadora.marca}</td>
            <td>${computadora.modelo}</td>
            <td>${computadora.ram} GB</td>
            <td>${computadora.procesador}</td>
            <td>${computadora.almacenamiento} GB</td>
            <td>
            <button class="btn btn-danger delete-computadora" onclick="eliminarComputadora(${computadora.id})">
                <i class="fas fa-trash"></i>
            </button>
            </td>
        </tr>
     `;
    tabla.innerHTML += fila;
  });
};

// Hacer una petición a la ruta /computadoras
(async () => {
  try {
    await fetchData();
  } catch (error) {
    console.log(error);
  }
})();

submitBtn.addEventListener("click", async () => {
  const marca = document.getElementById("marca").value;
  const modelo = document.getElementById("modelo").value;
  const ram = parseInt(document.getElementById("ram").value);
  const procesador = document.getElementById("procesador").value;
  const almacenamiento = parseInt(
    document.getElementById("almacenamiento").value
  );

  // crear objeto JavaScript para representar la nueva computadora
  const nuevaComputadora = {
    marca,
    modelo,
    ram,
    procesador,
    almacenamiento,
  };

  try {
    await fetch("/controller.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(nuevaComputadora),
    });
    location.reload();
  } catch (error) {
    location.reload();
  }
});
