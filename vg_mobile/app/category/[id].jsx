import React, { useEffect, useState } from 'react';
import { ScrollView, View, Text, Image, StyleSheet, ActivityIndicator } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { useRouter, useLocalSearchParams } from 'expo-router';

export default function CategoryPage() {
  const router = useRouter();
  const { id } = useLocalSearchParams(); // <-- Expo Router v1 way
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const API_BASE = "http://172.20.10.3:8003";

  useEffect(() => {
    if (!id) return;
    fetch(`${API_BASE}/api/produits`)
      .then(res => res.json())
      .then(data => {
        const filtered = (data.member ?? []).filter(p => p.categorie_id == id);
        setProducts(filtered);
      })
      .catch(err => console.error(err))
      .finally(() => setLoading(false));
  }, [id]);

  return (
    <SafeAreaView style={{ flex: 1, padding: 16 }}>
      {loading && <ActivityIndicator size="large" color="#025068" style={{ marginTop: 20 }} />}
      <Text style={{ fontSize: 22, fontWeight: 'bold', marginBottom: 16 }}>
        Products in this Category
      </Text>
      <ScrollView>
        {products.length === 0 ? (
          <Text>No products found in this category</Text>
        ) : (
          products.map(prod => (
            <View key={prod.id} style={styles.productCard}>
              {prod.photo ? (
                <Image source={{ uri: `${API_BASE}/${prod.photo}` }} style={styles.productImage} />
              ) : (
                <View style={[styles.productImage, styles.noImage]}>
                  <Text>No Image</Text>
                </View>
              )}
              <Text style={styles.productName}>{prod.nom_produit}</Text>
              <Text style={styles.productPrice}>${prod.vent_prix}</Text>
            </View>
          ))
        )}
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  productCard: {
    marginBottom: 16,
    padding: 16,
    backgroundColor: '#E6F4FE',
    borderRadius: 12,
  },
  productImage: { width: '100%', height: 180, borderRadius: 12 },
  noImage: { backgroundColor: '#ccc', justifyContent: 'center', alignItems: 'center' },
  productName: { fontSize: 18, fontWeight: 'bold', marginTop: 8 },
  productPrice: { fontSize: 16, color: '#333', marginTop: 4 },
});
