import React, { useEffect, useState } from 'react';
import { ScrollView, View, Text, Image, TouchableOpacity, StyleSheet, Dimensions, ActivityIndicator } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { useRouter } from 'expo-router';

const { width } = Dimensions.get('window');

export default function HomeScreen() {
  const [categories, setCategories] = useState([]);
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showSplash, setShowSplash] = useState(true);
  const router = useRouter();

  const API_BASE = "http://172.20.10.3:8003";

  useEffect(() => {
    const timer = setTimeout(() => setShowSplash(false), 4000);
    return () => clearTimeout(timer);
  }, []);

  useEffect(() => {
    fetch(`${API_BASE}/api/categories`)
      .then(res => res.json())
      .then(data => setCategories(data.member ?? []))
      .catch(err => console.error(err));

    fetch(`${API_BASE}/api/produits`)
      .then(res => res.json())
      .then(data => setProducts(data.member ?? []))
      .catch(err => console.error(err))
      .finally(() => setLoading(false));
  }, []);

  if (showSplash) {
    return (
      <SafeAreaView style={styles.splashSafe}>
        <View style={styles.splashContainer}>
          <Image source={require('../assets/images/logo.png')} style={styles.splashLogo} />
          <Text style={styles.splashText}>Welcome to Village Green App</Text>
        </View>
      </SafeAreaView>
    );
  }

  return (
    <SafeAreaView style={styles.safe}>
      {loading && <ActivityIndicator size="large" color="#025068" style={{ marginTop: 20 }} />}
      <ScrollView style={styles.container}>

        {/* Categories */}
        <Text style={styles.sectionTitle}>Categories</Text>
        <ScrollView horizontal showsHorizontalScrollIndicator={false} style={{ marginBottom: 16 }}>
          {categories.map(cat => (
            <TouchableOpacity
              key={cat.id}
              style={styles.categoryCard}
              onPress={() => router.push(`/category/${cat.id}`)} // <-- dynamic route
            >
              {cat.photo ? (
                <Image source={{ uri: `${API_BASE}/${cat.photo}` }} style={styles.categoryImage} />
              ) : (
                <Image source={require('../assets/images/guitar2.jpg')} style={styles.categoryImage} />
              )}
              <Text style={styles.categoryName}>{cat.nom_cat ?? 'No Name'}</Text>
              <Text style={styles.categoryButton}>View Products</Text>
            </TouchableOpacity>
          ))}
        </ScrollView>

        {/* All Products */}
        <Text style={styles.sectionTitle}>All Products</Text>
        {products.length === 0 ? (
          <Text style={styles.noProducts}>No products available</Text>
        ) : (
          products.map(prod => (
            <TouchableOpacity
              key={prod.id}
              style={styles.productCard}
              onPress={() => router.push(`/product/${prod.id}`)}
            >
              {prod.photo ? (
                <Image source={{ uri: `${API_BASE}/${prod.photo}` }} style={styles.productImage} />
              ) : (
                <View style={[styles.productImage, styles.noImage]}>
                  <Text>No Image</Text>
                </View>
              )}
              <Text style={styles.productName}>{prod.nom_produit ?? 'No Name'}</Text>
              <Text style={styles.productPrice}>${prod.vent_prix ?? '0'}</Text>
            </TouchableOpacity>
          ))
        )}
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  safe: { flex: 1, backgroundColor: '#fff' },
  container: { padding: 16 },
  splashSafe: { flex: 1, backgroundColor: '#fff' },
  splashContainer: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  splashLogo: { width: 120, height: 120, marginBottom: 20, resizeMode: 'contain' },
  splashText: { fontSize: 24, fontWeight: 'bold', textAlign: 'center' },
  sectionTitle: { fontSize: 22, fontWeight: 'bold', marginVertical: 8 },
  categoryCard: {
    backgroundColor: '#025068ff',
    padding: 16,
    borderRadius: 12,
    marginRight: 12,
    width: width * 0.6,
    justifyContent: 'center',
    alignItems: 'center',
  },
  categoryImage: { width: '100%', height: 120, borderRadius: 12, marginBottom: 8 },
  categoryName: { color: '#fff', fontWeight: 'bold', fontSize: 18 },
  categoryButton: { color: '#fff', fontSize: 14, fontWeight: '600', textDecorationLine: 'underline', marginTop: 4 },
  productCard: {
    marginVertical: 12,
    padding: 16,
    backgroundColor: '#E6F4FE',
    borderRadius: 12,
  },
  productImage: { width: '100%', height: 180, borderRadius: 12 },
  noImage: { backgroundColor: '#ccc', justifyContent: 'center', alignItems: 'center' },
  productName: { fontSize: 18, fontWeight: 'bold', marginTop: 10 },
  productPrice: { fontSize: 16, color: '#333', marginTop: 6 },
  noProducts: { fontSize: 16, color: '#999', marginTop: 8, textAlign: 'center' },
});
